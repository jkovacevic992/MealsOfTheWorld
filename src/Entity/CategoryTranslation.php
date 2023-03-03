<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

/**
 * @ORM\Entity()
 */
class CategoryTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;


    public static function getTranslatableEntityClass(): string
    {
        return Category::class;
    }

    public function setTranslatable(TranslatableInterface $translatable): void
    {
        // TODO: Implement setTranslatable() method.
    }

    public function getTranslatable(): TranslatableInterface
    {
        // TODO: Implement getTranslatable() method.
    }

    public function setLocale(string $locale): void
    {
        // TODO: Implement setLocale() method.
    }

    public function getLocale(): string
    {
        // TODO: Implement getLocale() method.
    }

    public function isEmpty(): bool
    {
        // TODO: Implement isEmpty() method.
    }
}