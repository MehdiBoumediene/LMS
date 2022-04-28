<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220417220712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_modules (users_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_DEB7371D67B3B43D (users_id), INDEX IDX_DEB7371D60D6DC42 (modules_id), PRIMARY KEY(users_id, modules_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_modules ADD CONSTRAINT FK_DEB7371D67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_modules ADD CONSTRAINT FK_DEB7371D60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_modules');
    }
}
