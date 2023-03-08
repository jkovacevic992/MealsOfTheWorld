<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'tag')]
class Tag
{
    /**
     * @param int $id
     * @param string $slug
     * @param string $title
     * @param string $locale
     * @param ArrayCollection $meals
     */
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'integer')]
        #[ORM\GeneratedValue]
        private int $id,
        #[ORM\Column(type: 'string')]
        private string $slug,
        #[ORM\Column(type: 'string')]
        #[Gedmo\Translatable]
        private string $title,
        #[Gedmo\Locale]
        private string $locale,
        /**
         * @var ArrayCollection<int, Meal>
         */
        #[ORM\ManyToMany(targetEntity: 'Meal', mappedBy: 'tags')]
        private ArrayCollection $meals
    ){
        $this->meals = new ArrayCollection();
    }

    /**
     * @param string $locale
     * @return void
     */
    public function setTranslatableLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
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
