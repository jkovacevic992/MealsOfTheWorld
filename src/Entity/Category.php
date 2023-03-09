<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity]
#[ORM\Table(name: 'category')]
class Category
{
    /**
     * @param int $id
     * @param string $slug
     * @param string $title
     * @param string $locale
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
        private string $locale
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
     * @param string $locale
     * @return void
     */
    public function setTranslatableLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
