<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102183636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task (task_id INT AUTO_INCREMENT NOT NULL, ekipa_id INT DEFAULT NULL, about VARCHAR(255) NOT NULL, data_reg DATETIME NOT NULL, time_exec DATETIME NOT NULL, type VARCHAR(255) NOT NULL, priority INT NOT NULL, INDEX IDX_527EDB25B82B5BB0 (ekipa_id), PRIMARY KEY(task_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25B82B5BB0 FOREIGN KEY (ekipa_id) REFERENCES team (ekipa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25B82B5BB0');
        $this->addSql('DROP TABLE task');
    }
}
