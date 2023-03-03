<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ingredient")
 */
class Ingredient
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
     * @ORM\Column(type="string")
     * @Gedmo\Translatable()
     */
    private $title;

    /**
     * @Gedmo\Locale()
     */
    private $locale;

    /**
     * @ManyToMany(targetEntity="Meal", mappedBy="ingredients")
     * @var ArrayCollection<int, Meal>
     */
    private $meals;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
    }

    /**
     * @param $locale
     * @return void
     */
    public function setTranslatableLocale($locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @param Meal $meal
     * @return void
     */
    public function addMeal(Meal $meal)
    {
        $this->meals->add($meal);
    }
}