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
    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $status
     * @param string $locale
     * @param DateTime $createdAt
     * @param Category $category
     * @param ArrayCollection $tags
     * @param ArrayCollection $ingredients
     */
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'integer')]
        #[ORM\GeneratedValue]
        private int $id,
        #[ORM\Column(type: 'string')]
        #[Gedmo\Translatable]
        private string $title,
        #[ORM\Column(type: 'string')]
        #[Gedmo\Translatable]
        private string $description,
        #[ORM\Column(type: 'string', options: ['default' => 'created'])]
        private string $status,
        #[Gedmo\Locale]
        private string $locale,
        #[ORM\Column(type: 'datetime')]
        private DateTime $createdAt,
        #[ORM\ManyToOne(targetEntity: Category::class)]
        #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: true)]
        private Category $category,
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
        private ArrayCollection $ingredients
    )
    {
        $this->tags = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
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
    public function getDescription(): mixed
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
     * @return mixed
     */
    public function getCategory(): mixed
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory(mixed $category): void
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
     * @return mixed
     */
    public function getStatus(): mixed
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus(mixed $status): void
    {
        $this->status = $status;
    }
}
