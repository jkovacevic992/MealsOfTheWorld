<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'meal')]
class Meal
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', options: ['default' => 'created'])]
    private string $status;

    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: 'create')]
    private DateTime $createdAt;
    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'meals')]
    #[ORM\JoinTable(name: 'meals_tags')]
    private Collection $tags;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'meals')]
    #[ORM\JoinTable(name: 'meals_ingredients')]
    private Collection $ingredients;

    /**
     * @param string $title
     * @param string $description
     * @param string|null $locale
     * @param Category|null $category
     */
    public function __construct(
        #[ORM\Column(type: 'string')]
        #[Gedmo\Translatable]
        private string $title,
        #[ORM\Column(type: 'string')]
        #[Gedmo\Translatable]
        private string $description,

        #[Gedmo\Locale]
        private ?string $locale = null,

        #[ORM\ManyToOne(targetEntity: Category::class)]
        #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: true)]
        private ?Category $category = null
    )
    {
        $this->tags = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(mixed $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitle(): string
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
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
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return void
     */
    public function addTag(Tag $tag): void
    {
        $this->tags->add($tag);
    }

    /**
     * @param Ingredient $ingredient
     * @return void
     */
    public function addIngredient(Ingredient $ingredient): void
    {
        $this->ingredients->add($ingredient);
    }

    /**
     * @return Collection
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }
}
