<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309094701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create meals_tags table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE meals_tags (meal_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_F83DC9A6639666D6 (meal_id), INDEX IDX_F83DC9A6BAD26311 (tag_id), PRIMARY KEY(meal_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meals_tags ADD CONSTRAINT FK_F83DC9A6639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_tags ADD CONSTRAINT FK_F83DC9A6BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE meals_tags DROP FOREIGN KEY FK_F83DC9A6639666D6');
        $this->addSql('ALTER TABLE meals_tags DROP FOREIGN KEY FK_F83DC9A6BAD26311');
        $this->addSql('DROP TABLE meals_tags');
    }
}
