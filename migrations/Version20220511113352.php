<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511113352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesmodules ADD formations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesmodules ADD CONSTRAINT FK_AFA142B93BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_AFA142B93BF5B0C2 ON lesmodules (formations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesmodules DROP FOREIGN KEY FK_AFA142B93BF5B0C2');
        $this->addSql('DROP INDEX IDX_AFA142B93BF5B0C2 ON lesmodules');
        $this->addSql('ALTER TABLE lesmodules DROP formations_id');
    }
}
