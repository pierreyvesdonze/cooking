<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021133836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE weekly_day (id INT AUTO_INCREMENT NOT NULL, weekly_menu_id INT NOT NULL, day VARCHAR(255) NOT NULL, breakfast VARCHAR(255) NOT NULL, lunch VARCHAR(255) NOT NULL, dinner VARCHAR(255) NOT NULL, INDEX IDX_F22A2655C4A7451D (weekly_menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE weekly_day ADD CONSTRAINT FK_F22A2655C4A7451D FOREIGN KEY (weekly_menu_id) REFERENCES weekly_menu (id)');
        $this->addSql('ALTER TABLE weekly_menu DROP breakfast, DROP first_snack, DROP lunch, DROP second_snack, DROP dinner');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE weekly_day DROP FOREIGN KEY FK_F22A2655C4A7451D');
        $this->addSql('DROP TABLE weekly_day');
        $this->addSql('ALTER TABLE weekly_menu ADD breakfast VARCHAR(255) DEFAULT NULL, ADD first_snack VARCHAR(255) DEFAULT NULL, ADD lunch VARCHAR(255) DEFAULT NULL, ADD second_snack VARCHAR(255) DEFAULT NULL, ADD dinner VARCHAR(255) DEFAULT NULL');
    }
}
