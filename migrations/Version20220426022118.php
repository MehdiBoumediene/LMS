<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426022118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes ADD calendrier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendrier (id)');
        $this->addSql('CREATE INDEX IDX_2ED7EC5FF52FC51 ON classes (calendrier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5FF52FC51');
        $this->addSql('DROP INDEX IDX_2ED7EC5FF52FC51 ON classes');
        $this->addSql('ALTER TABLE classes DROP calendrier_id');
    }
}
