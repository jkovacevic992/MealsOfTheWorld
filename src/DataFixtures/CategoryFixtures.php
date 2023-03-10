<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category(
                slug: 'category-' . $i,
                title: 'Category ' . $i . ' English Title'
            );
            $repository->translate($category, 'title', 'de', 'Category ' . $i . ' German Title');
            $manager->persist($category);
        }
        $manager->flush();
    }
}
