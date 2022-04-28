<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331114212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_classes (users_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_F2ED0A0F67B3B43D (users_id), INDEX IDX_F2ED0A0F9E225B24 (classes_id), PRIMARY KEY(users_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_classes ADD CONSTRAINT FK_F2ED0A0F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_classes ADD CONSTRAINT FK_F2ED0A0F9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9A4AEAFEA ON users (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_classes');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A4AEAFEA');
        $this->addSql('DROP INDEX IDX_1483A5E9A4AEAFEA ON users');
        $this->addSql('ALTER TABLE users DROP entreprise_id');
    }
}
