<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511110133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE leschapitres (id INT AUTO_INCREMENT NOT NULL, bloc_id INT DEFAULT NULL, classes_id INT DEFAULT NULL, users_id INT DEFAULT NULL, formations_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_DCFF8E555582E9C0 (bloc_id), INDEX IDX_DCFF8E559E225B24 (classes_id), INDEX IDX_DCFF8E5567B3B43D (users_id), INDEX IDX_DCFF8E553BF5B0C2 (formations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesmodules (id INT AUTO_INCREMENT NOT NULL, leschapitres_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, INDEX IDX_AFA142B9843473FF (leschapitres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE leschapitres ADD CONSTRAINT FK_DCFF8E555582E9C0 FOREIGN KEY (bloc_id) REFERENCES blocs (id)');
        $this->addSql('ALTER TABLE leschapitres ADD CONSTRAINT FK_DCFF8E559E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE leschapitres ADD CONSTRAINT FK_DCFF8E5567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE leschapitres ADD CONSTRAINT FK_DCFF8E553BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE lesmodules ADD CONSTRAINT FK_AFA142B9843473FF FOREIGN KEY (leschapitres_id) REFERENCES leschapitres (id)');
        $this->addSql('ALTER TABLE couvertures ADD leschapitres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE couvertures ADD CONSTRAINT FK_1B72DAD6843473FF FOREIGN KEY (leschapitres_id) REFERENCES leschapitres (id)');
        $this->addSql('CREATE INDEX IDX_1B72DAD6843473FF ON couvertures (leschapitres_id)');
        $this->addSql('ALTER TABLE files ADD leschapitres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_6354059843473FF FOREIGN KEY (leschapitres_id) REFERENCES leschapitres (id)');
        $this->addSql('CREATE INDEX IDX_6354059843473FF ON files (leschapitres_id)');
        $this->addSql('ALTER TABLE medias ADD leschapitres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF81843473FF FOREIGN KEY (leschapitres_id) REFERENCES leschapitres (id)');
        $this->addSql('CREATE INDEX IDX_12D2AF81843473FF ON medias (leschapitres_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE couvertures DROP FOREIGN KEY FK_1B72DAD6843473FF');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_6354059843473FF');
        $this->addSql('ALTER TABLE lesmodules DROP FOREIGN KEY FK_AFA142B9843473FF');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF81843473FF');
        $this->addSql('DROP TABLE leschapitres');
        $this->addSql('DROP TABLE lesmodules');
        $this->addSql('DROP INDEX IDX_1B72DAD6843473FF ON couvertures');
        $this->addSql('ALTER TABLE couvertures DROP leschapitres_id');
        $this->addSql('DROP INDEX IDX_6354059843473FF ON files');
        $this->addSql('ALTER TABLE files DROP leschapitres_id');
        $this->addSql('DROP INDEX IDX_12D2AF81843473FF ON medias');
        $this->addSql('ALTER TABLE medias DROP leschapitres_id');
    }
}
