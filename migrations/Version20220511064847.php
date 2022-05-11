<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511064847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE telechargements (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_623AB077A76ED395 (user_id), INDEX IDX_623AB0778F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE telechargements ADD CONSTRAINT FK_623AB077A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE telechargements ADD CONSTRAINT FK_623AB0778F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE files ADD telechargements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_63540591536CC8D FOREIGN KEY (telechargements_id) REFERENCES telechargements (id)');
        $this->addSql('CREATE INDEX IDX_63540591536CC8D ON files (telechargements_id)');
        $this->addSql('ALTER TABLE users ADD timer VARCHAR(255) DEFAULT NULL, ADD time_plateforme DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_63540591536CC8D');
        $this->addSql('DROP TABLE telechargements');
        $this->addSql('DROP INDEX IDX_63540591536CC8D ON files');
        $this->addSql('ALTER TABLE files DROP telechargements_id');
        $this->addSql('ALTER TABLE users DROP timer, DROP time_plateforme');
    }
}
