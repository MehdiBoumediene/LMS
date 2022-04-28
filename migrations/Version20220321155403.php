<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321155403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blocs (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) NOT NULL, INDEX IDX_90770F748F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprises (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, responsable VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteurs (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_58316743A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blocs ADD CONSTRAINT FK_90770F748F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_58316743A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs DROP FOREIGN KEY FK_90770F748F5EA509');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_58316743A4AEAFEA');
        $this->addSql('DROP TABLE blocs');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE entreprises');
        $this->addSql('DROP TABLE tuteurs');
    }
}
