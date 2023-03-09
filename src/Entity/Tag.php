<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'tag')]
class Tag
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    /**
     * @var Collection<int, Meal>
     */
    #[ORM\ManyToMany(targetEntity: 'Meal', mappedBy: 'tags')]
    private Collection $meals;

    #[Gedmo\Locale]
    private $locale;

    /**
     * @param string $slug
     * @param string $title
     */
    public function __construct(
        #[ORM\Column(type: 'string')]
        private string $slug,
        #[ORM\Column(type: 'string')]
        #[Gedmo\Translatable]
        private string $title
    ){
        $this->meals = new ArrayCollection();
    }

    /**
     * @param string|null $locale
     * @return void
     */
    public function setLocale(?string $locale): void
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
     * @return Collection
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }
}
