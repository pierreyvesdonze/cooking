<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230724143627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13712469DE2 FOREIGN KEY (category_id) REFERENCES recipe_category (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13712469DE2 ON recipe (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13712469DE2');
        $this->addSql('DROP TABLE recipe_category');
        $this->addSql('DROP INDEX IDX_DA88B13712469DE2 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP category_id');
    }
}
