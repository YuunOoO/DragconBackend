<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103200236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tool CHANGE ekipa_id ekipa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tool ADD CONSTRAINT FK_20F33ED1B82B5BB0 FOREIGN KEY (ekipa_id) REFERENCES team (ekipa_id)');
        $this->addSql('CREATE INDEX IDX_20F33ED1B82B5BB0 ON tool (ekipa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tool DROP FOREIGN KEY FK_20F33ED1B82B5BB0');
        $this->addSql('DROP INDEX IDX_20F33ED1B82B5BB0 ON tool');
        $this->addSql('ALTER TABLE tool CHANGE ekipa_id ekipa_id INT NOT NULL');
    }
}
