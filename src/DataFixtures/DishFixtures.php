<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Ingredient;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DishFixtures extends Fixture implements DependentFixtureInterface
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
            $dish = new Dish();
            $dish->setTitle('Dish ' . $i . ' English Title');
            $dish->addTag($manager->getRepository(Tag::class)->find($i));
            $dish->addIngredient($manager->getRepository(Ingredient::class)->find($i));
            if ($i < 5) {
                $dish->addTag($manager->getRepository(Tag::class)->find($i+1));
                $dish->addIngredient($manager->getRepository(Ingredient::class)->find($i+1));
                $dish->setCategory($manager->getRepository(Category::class)->find($i));
            }

            $dish->setCreatedAt(new \DateTime('now'));
            $dish->setDescription('Dish ' . $i . ' English Description');
            $repository->translate($dish,'title','de','Dish ' . $i . ' German Title');
            $repository->translate($dish,'description','de','Dish ' . $i . ' German Description');
            $manager->persist($dish);
        }
        $manager->flush();
    }
}