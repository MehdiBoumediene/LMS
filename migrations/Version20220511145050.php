<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511145050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesmodules ADD blocs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesmodules ADD CONSTRAINT FK_AFA142B97C40FD7C FOREIGN KEY (blocs_id) REFERENCES blocs (id)');
        $this->addSql('CREATE INDEX IDX_AFA142B97C40FD7C ON lesmodules (blocs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesmodules DROP FOREIGN KEY FK_AFA142B97C40FD7C');
        $this->addSql('DROP INDEX IDX_AFA142B97C40FD7C ON lesmodules');
        $this->addSql('ALTER TABLE lesmodules DROP blocs_id');
    }
}
