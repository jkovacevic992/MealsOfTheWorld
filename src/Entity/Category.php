<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="category")
 */
class Category implements TranslatableInterface
{
    use TranslatableTrait;
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
        return CategoryTranslation::class;
    }
}