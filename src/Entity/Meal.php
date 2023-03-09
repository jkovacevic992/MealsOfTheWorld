<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @param string $title
     * @param string $description
     * @param ArrayCollection $tags
     * @param ArrayCollection $ingredients
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
        /**
         * @var ArrayCollection<int, Tag>
         */
        #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'meals')]
        #[ORM\JoinTable(name: 'meals_tags')]
        private ArrayCollection $tags,
        /**
         * @var ArrayCollection<int, Ingredient>
         */
        #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'meals')]
        #[ORM\JoinTable(name: 'meals_ingredients')]
        private ArrayCollection $ingredients,
        #[Gedmo\Locale]
        private ?string $locale = null,
        #[ORM\ManyToOne(targetEntity: Category::class)]
        #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: true)]
        private ?Category $category = null
    )
    {
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
     * @return ArrayCollection
     */
    public function getTags(): ArrayCollection
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
     * @return ArrayCollection
     */
    public function getIngredients(): ArrayCollection
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
}
