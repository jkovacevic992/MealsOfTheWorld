<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Meal;
use App\Entity\Ingredient;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class MealFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            IngredientFixtures::class,
            TagFixtures::class
        ];
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        for ($i = 1; $i <= 10; $i++) {
            $meal = new Meal(
                title: 'Meal ' . $i . ' English Title',
                description: 'Meal ' . $i . ' English Description',
                tags: new ArrayCollection([
                    $manager->getRepository(Tag::class)->findOneBy(['slug' => 'tag-' . $i]),
                    $manager->getRepository(Tag::class)->findOneBy(['slug' => 'tag-' . $i+1])
                ]),
                ingredients: new ArrayCollection([
                    $manager->getRepository(Ingredient::class)->findOneBy(['slug' => 'ingredient-' . $i]),
                    $manager->getRepository(Ingredient::class)->findOneBy(['slug' => 'ingredient-' . $i+1])
                ])

            );
            if ($i < 8) {
                $meal->setCategory($manager->getRepository(Category::class)->findOneBy(['slug' => 'category-' . $i]));
            }
            $meal->setStatus('created');
            $repository->translate($meal, 'title', 'de', 'Meal ' . $i . ' German Title');
            $repository->translate($meal, 'description', 'de', 'Meal ' . $i . ' German Description');
            $manager->persist($meal);
        }
        $manager->flush();
    }
}
