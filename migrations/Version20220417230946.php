<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220417230946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users_modules');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D7A76ED395');
        $this->addSql('DROP INDEX IDX_2EB743D7A76ED395 ON modules');
        $this->addSql('ALTER TABLE modules CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D767B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2EB743D767B3B43D ON modules (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_modules (users_id INT NOT NULL, modules_id INT NOT NULL, INDEX IDX_DEB7371D67B3B43D (users_id), INDEX IDX_DEB7371D60D6DC42 (modules_id), PRIMARY KEY(users_id, modules_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_modules ADD CONSTRAINT FK_DEB7371D60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_modules ADD CONSTRAINT FK_DEB7371D67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D767B3B43D');
        $this->addSql('DROP INDEX IDX_2EB743D767B3B43D ON modules');
        $this->addSql('ALTER TABLE modules CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D7A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2EB743D7A76ED395 ON modules (user_id)');
    }
}
