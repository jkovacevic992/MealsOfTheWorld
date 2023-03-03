<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Meal;
use App\Entity\Ingredient;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

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
        for ($i = 1; $i <= 5; $i++) {
            $meal = new Meal();
            $meal->setTitle('Meal ' . $i . ' English Title');
            $meal->addTag($manager->getRepository(Tag::class)->findOneBy(['slug' => 'tag-' . $i]));
            $meal->addIngredient($manager->getRepository(Ingredient::class)->findOneBy(['slug' => 'ingredient-' . $i]));
            if ($i < 5) {
                $meal->addTag($manager->getRepository(Tag::class)->findOneBy(['slug' => 'tag-' . $i+1]));
                $meal->addIngredient($manager->getRepository(Ingredient::class)->findOneBy(['slug' => 'ingredient-' . $i+1]));
                $meal->setCategory($manager->getRepository(Category::class)->findOneBy(['slug' => 'category-' . $i]));
            }

            $meal->setCreatedAt(new \DateTime('now'));
            $meal->setDescription('Meal ' . $i . ' English Description');
            $repository->translate($meal,'title','de','Meal ' . $i . ' German Title');
            $repository->translate($meal,'description','de','Meal ' . $i . ' German Description');
            $manager->persist($meal);
        }
        $manager->flush();
    }
}