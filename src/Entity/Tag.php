<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\Column(type="string")
     * @Gedmo\Translatable()
     */
    private $title;

    /**
     * @Gedmo\Locale()
     */
    private $locale;

    /**
     * @ManyToMany(targetEntity="Meal", mappedBy="tags")
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
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSlug(): mixed
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug(mixed $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getTitle(): mixed
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(mixed $title): void
    {
        $this->title = $title;
    }

    /**
     * @param Meal $meal
     * @return void
     */
    public function addMeal(Meal $meal): void
    {
        $this->meals->add($meal);
    }

    /**
     * @return ArrayCollection
     */
    public function getMeals(): ArrayCollection
    {
        return $this->meals;
    }
}
