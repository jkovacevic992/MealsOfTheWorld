<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ManyToMany(targetEntity="Dish", mappedBy="tag")
     * @var ArrayCollection<int, Dish>
     */
    private $dish;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    public function __construct()
    {
        $this->dish = new ArrayCollection();
    }
}