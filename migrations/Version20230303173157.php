<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303173157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, created_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_9EF68E9C12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meals_tags (meal_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F83DC9A6639666D6 (meal_id), INDEX IDX_F83DC9A6BAD26311 (tag_id), PRIMARY KEY(meal_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meals_ingredients (meal_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_DF77A0AB639666D6 (meal_id), INDEX IDX_DF77A0AB933FE08C (ingredient_id), PRIMARY KEY(meal_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE meals_tags ADD CONSTRAINT FK_F83DC9A6639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_tags ADD CONSTRAINT FK_F83DC9A6BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C12469DE2');
        $this->addSql('ALTER TABLE meals_tags DROP FOREIGN KEY FK_F83DC9A6639666D6');
        $this->addSql('ALTER TABLE meals_tags DROP FOREIGN KEY FK_F83DC9A6BAD26311');
        $this->addSql('ALTER TABLE meals_ingredients DROP FOREIGN KEY FK_DF77A0AB639666D6');
        $this->addSql('ALTER TABLE meals_ingredients DROP FOREIGN KEY FK_DF77A0AB933FE08C');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meals_tags');
        $this->addSql('DROP TABLE meals_ingredients');
        $this->addSql('DROP TABLE tag');
    }
}
