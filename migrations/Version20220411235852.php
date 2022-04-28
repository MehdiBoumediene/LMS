<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411235852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiants ADD classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EB9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_227C02EB9E225B24 ON etudiants (classes_id)');
        $this->addSql('ALTER TABLE intervenants ADD classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C09E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_79A002C09E225B24 ON intervenants (classes_id)');
        $this->addSql('ALTER TABLE modules ADD classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D79E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_2EB743D79E225B24 ON modules (classes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EB9E225B24');
        $this->addSql('DROP INDEX IDX_227C02EB9E225B24 ON etudiants');
        $this->addSql('ALTER TABLE etudiants DROP classes_id');
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C09E225B24');
        $this->addSql('DROP INDEX IDX_79A002C09E225B24 ON intervenants');
        $this->addSql('ALTER TABLE intervenants DROP classes_id');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D79E225B24');
        $this->addSql('DROP INDEX IDX_2EB743D79E225B24 ON modules');
        $this->addSql('ALTER TABLE modules DROP classes_id');
    }
}
