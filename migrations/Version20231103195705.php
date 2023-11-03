<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103195705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE ekipa_id ekipa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B82B5BB0 FOREIGN KEY (ekipa_id) REFERENCES team (ekipa_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B82B5BB0 ON user (ekipa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B82B5BB0');
        $this->addSql('DROP INDEX IDX_8D93D649B82B5BB0 ON user');
        $this->addSql('ALTER TABLE user CHANGE ekipa_id ekipa_id INT NOT NULL');
    }
}
