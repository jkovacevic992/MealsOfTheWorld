<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="dish")
 */
class Dish implements TranslatableInterface
{
    use TranslatableTrait;

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

    public function getTranslations()
    {
        // TODO: Implement getTranslations() method.
    }

    public function getNewTranslations(): Collection
    {
        // TODO: Implement getNewTranslations() method.
    }

    public function addTranslation(TranslationInterface $translation): void
    {
        // TODO: Implement addTranslation() method.
    }

    public function removeTranslation(TranslationInterface $translation): void
    {
        // TODO: Implement removeTranslation() method.
    }

    public function translate(?string $locale = null, bool $fallbackToDefault = true): TranslationInterface
    {
        // TODO: Implement translate() method.
    }

    public function mergeNewTranslations(): void
    {
        // TODO: Implement mergeNewTranslations() method.
    }

    public function setCurrentLocale(string $locale): void
    {
        // TODO: Implement setCurrentLocale() method.
    }

    public function getCurrentLocale(): string
    {
        // TODO: Implement getCurrentLocale() method.
    }

    public function setDefaultLocale(string $locale): void
    {
        // TODO: Implement setDefaultLocale() method.
    }

    public function getDefaultLocale(): string
    {
        // TODO: Implement getDefaultLocale() method.
    }

    public static function getTranslationEntityClass(): string
    {
        return DishTranslation::class;
    }
}