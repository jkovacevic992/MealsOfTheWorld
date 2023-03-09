<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309094758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE meals_ingredients (meal_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_DF77A0AB639666D6 (meal_id), INDEX IDX_DF77A0AB933FE08C (ingredient_id), PRIMARY KEY(meal_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE meals_ingredients DROP FOREIGN KEY FK_DF77A0AB639666D6');
        $this->addSql('ALTER TABLE meals_ingredients DROP FOREIGN KEY FK_DF77A0AB933FE08C');
        $this->addSql('DROP TABLE meals_ingredients');
    }
}
