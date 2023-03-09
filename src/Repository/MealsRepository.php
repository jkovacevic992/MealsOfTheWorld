<?php

namespace App\Repository;

use App\Entity\Meal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MealsRepository extends ServiceEntityRepository implements MealsRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meal::class);
    }

    /**
     * @param array $requestData
     * @return array|null
     */
    public function findMeals(array $requestData): ?array
    {
        $qb = $this->createQueryBuilder('m')
            ->leftJoin('m.category', 'c')
            ->innerJoin('m.tags', 't')
            ->leftJoin('m.ingredients', 'i')
            ->addSelect('t');
        if (count($requestData) === 1 && array_key_exists('lang',$requestData)) {
            $qb->groupBy('m.id');
        }
        if (array_key_exists('category', $requestData)) {
            if (strtoupper($requestData['category']) === 'NULL') {
                $qb->andWhere('c.id IS NULL');
            } elseif (strtoupper($requestData['category']) === '!NULL') {
                $qb->andWhere('c.id IS NOT NULL');
            } else {
                $qb->andWhere('c.id = :categoryId')
                    ->setParameter('categoryId', $requestData['category']);
            }
        }

        if (array_key_exists('tags', $requestData)) {
            $qb->andWhere(':tags MEMBER OF m.tags')
                ->setParameter('tags', explode(',',$requestData['tags']));
        }
        if (array_key_exists('with', $requestData)) {
            $with = explode(',', $requestData['with']);
            if (in_array('category', $with)) {
                $qb->addSelect('c');
            }
            if (in_array('ingredients', $with)) {
                $qb->addSelect('i');
            }
        }

        if (array_key_exists('diff_time', $requestData)) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp(($requestData['diff_time']));
            $qb->andWhere('m.createdAt > :time')
            ->setParameter('time', $dateTime->format('Y-m-d H:i:s'));
        }
        $query = $qb->getQuery();
        $query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );
        $query->setHint(
            \Gedmo\Translatable\TranslatableListener::HINT_TRANSLATABLE_LOCALE,
            $requestData['lang']
        );
        $query->setHint(
            \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
            1 // fallback to default values in case if record is not translated
        );
        return $query->getArrayResult();
    }
}
