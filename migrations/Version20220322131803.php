<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220322131803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE absences (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_F9C0EFFFAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE absences_etudiants (absences_id INT NOT NULL, etudiants_id INT NOT NULL, INDEX IDX_E06802E59A5BDCB7 (absences_id), INDEX IDX_E06802E5A873A5C6 (etudiants_id), PRIMARY KEY(absences_id, etudiants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE absences_intervenants (absences_id INT NOT NULL, intervenants_id INT NOT NULL, INDEX IDX_69E4FB759A5BDCB7 (absences_id), INDEX IDX_69E4FB75130E9263 (intervenants_id), PRIMARY KEY(absences_id, intervenants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, intervenant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_A2B07288AFC2B591 (module_id), INDEX IDX_A2B07288AB9A1716 (intervenant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiants (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiants_modules (etudiants_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_D43B3B6AA873A5C6 (etudiants_id), INDEX IDX_D43B3B6A60D6DC42 (modules_id), PRIMARY KEY(etudiants_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenants (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenants_modules (intervenants_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_5A1867E4130E9263 (intervenants_id), INDEX IDX_5A1867E460D6DC42 (modules_id), PRIMARY KEY(intervenants_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modules (id INT AUTO_INCREMENT NOT NULL, bloc_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_2EB743D75582E9C0 (bloc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFFAFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE absences_etudiants ADD CONSTRAINT FK_E06802E59A5BDCB7 FOREIGN KEY (absences_id) REFERENCES absences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absences_etudiants ADD CONSTRAINT FK_E06802E5A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absences_intervenants ADD CONSTRAINT FK_69E4FB759A5BDCB7 FOREIGN KEY (absences_id) REFERENCES absences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE absences_intervenants ADD CONSTRAINT FK_69E4FB75130E9263 FOREIGN KEY (intervenants_id) REFERENCES intervenants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288AFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenants (id)');
        $this->addSql('ALTER TABLE etudiants_modules ADD CONSTRAINT FK_D43B3B6AA873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiants_modules ADD CONSTRAINT FK_D43B3B6A60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenants_modules ADD CONSTRAINT FK_5A1867E4130E9263 FOREIGN KEY (intervenants_id) REFERENCES intervenants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenants_modules ADD CONSTRAINT FK_5A1867E460D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D75582E9C0 FOREIGN KEY (bloc_id) REFERENCES blocs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences_etudiants DROP FOREIGN KEY FK_E06802E59A5BDCB7');
        $this->addSql('ALTER TABLE absences_intervenants DROP FOREIGN KEY FK_69E4FB759A5BDCB7');
        $this->addSql('ALTER TABLE absences_etudiants DROP FOREIGN KEY FK_E06802E5A873A5C6');
        $this->addSql('ALTER TABLE etudiants_modules DROP FOREIGN KEY FK_D43B3B6AA873A5C6');
        $this->addSql('ALTER TABLE absences_intervenants DROP FOREIGN KEY FK_69E4FB75130E9263');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288AB9A1716');
        $this->addSql('ALTER TABLE intervenants_modules DROP FOREIGN KEY FK_5A1867E4130E9263');
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFFAFC2B591');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288AFC2B591');
        $this->addSql('ALTER TABLE etudiants_modules DROP FOREIGN KEY FK_D43B3B6A60D6DC42');
        $this->addSql('ALTER TABLE intervenants_modules DROP FOREIGN KEY FK_5A1867E460D6DC42');
        $this->addSql('DROP TABLE absences');
        $this->addSql('DROP TABLE absences_etudiants');
        $this->addSql('DROP TABLE absences_intervenants');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE etudiants');
        $this->addSql('DROP TABLE etudiants_modules');
        $this->addSql('DROP TABLE intervenants');
        $this->addSql('DROP TABLE intervenants_modules');
        $this->addSql('DROP TABLE modules');
    }
}
