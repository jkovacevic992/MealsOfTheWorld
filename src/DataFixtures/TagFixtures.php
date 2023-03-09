<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        for ($i = 1; $i <= 10; $i++) {
            $tag = new Tag(
                slug: 'tag-' . $i,
                title: 'Tag ' . $i . ' English Title'
            );
            $repository->translate($tag, 'title', 'de', 'Tag ' . $i . ' German Title');
            $manager->persist($tag);
        }
        $manager->flush();
    }
}
