<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511080823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitres DROP FOREIGN KEY FK_508679FCAFC2B591');
        $this->addSql('DROP INDEX IDX_508679FCAFC2B591 ON chapitres');
        $this->addSql('ALTER TABLE chapitres CHANGE module_id modules_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chapitres ADD CONSTRAINT FK_508679FC60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id)');
        $this->addSql('CREATE INDEX IDX_508679FC60D6DC42 ON chapitres (modules_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitres DROP FOREIGN KEY FK_508679FC60D6DC42');
        $this->addSql('DROP INDEX IDX_508679FC60D6DC42 ON chapitres');
        $this->addSql('ALTER TABLE chapitres CHANGE modules_id module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chapitres ADD CONSTRAINT FK_508679FCAFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('CREATE INDEX IDX_508679FCAFC2B591 ON chapitres (module_id)');
    }
}
