<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ingredient")
 */
class Ingredient implements TranslatableInterface
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
     * @ManyToMany(targetEntity="Dish", mappedBy="ingredient")
     * @var ArrayCollection<int, Dish>
     */
    private $dish;

    public function __construct()
    {
        $this->dish = new ArrayCollection();
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
        return IngredientTranslation::class;
    }
}