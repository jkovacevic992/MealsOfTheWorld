<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        for ($i = 1; $i <= 10; $i++) {
            $ingredient = new Ingredient(
                slug: 'ingredient-' . $i,
                title: 'Ingredient ' . $i . ' English Title'
            );
            $repository->translate($ingredient, 'title', 'de', 'Ingredient ' . $i . ' German Title');
            $manager->persist($ingredient);
        }
        $manager->flush();
    }
}
