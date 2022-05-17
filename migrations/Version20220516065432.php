<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516065432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE times (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, chapitre_id INT DEFAULT NULL, heur VARCHAR(255) DEFAULT NULL, minutes VARCHAR(255) DEFAULT NULL, secondes VARCHAR(255) DEFAULT NULL, INDEX IDX_1DD7EE8CA76ED395 (user_id), INDEX IDX_1DD7EE8C1FBEEF7B (chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE times ADD CONSTRAINT FK_1DD7EE8CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE times ADD CONSTRAINT FK_1DD7EE8C1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES leschapitres (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE times');
    }
}
