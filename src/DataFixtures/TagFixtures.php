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
        for ($i = 1; $i <= 5; $i++) {
            $tag = new Tag();
            $tag->setTitle('Tag ' . $i . ' English Title');
            $tag->setSlug('tag-' . $i);
            $repository->translate($tag,'title','de','Tag ' . $i . ' German Title');
            $manager->persist($tag);
        }
        $manager->flush();
    }
}