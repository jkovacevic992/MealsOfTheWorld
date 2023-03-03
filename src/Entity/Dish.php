<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dish")
 */
class Dish
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ManyToMany(targetEntity="Tag", inversedBy="dish")
     * @JoinTable(name="dish_tag")
     * @var ArrayCollection<int, Tag>
     */
    private $tag;

    /**
     * @ManyToOne(targetEntity="Category")
     * @JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $category;

    /**
     * @ManyToMany(targetEntity="Ingredient", inversedBy="dish")
     * @JoinTable(name="dish_ingredient")
     * @var ArrayCollection<int, Ingredient>
     */
    private $ingredient;

    /**
     * @var DateTime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;


    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
    }
    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->ingredient = new ArrayCollection();
    }
}