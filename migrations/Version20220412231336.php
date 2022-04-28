<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412231336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blocs ADD CONSTRAINT FK_90770F74A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_90770F74A76ED395 ON blocs (user_id)');
        $this->addSql('ALTER TABLE entreprises ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprises ADD CONSTRAINT FK_56B1B7A9A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_56B1B7A9A76ED395 ON entreprises (user_id)');
        $this->addSql('ALTER TABLE etudiants ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiants ADD CONSTRAINT FK_227C02EBA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_227C02EBA76ED395 ON etudiants (user_id)');
        $this->addSql('ALTER TABLE intervenants ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_79A002C0A76ED395 ON intervenants (user_id)');
        $this->addSql('ALTER TABLE modules ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modules ADD CONSTRAINT FK_2EB743D7A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_2EB743D7A76ED395 ON modules (user_id)');
        $this->addSql('ALTER TABLE tuteurs ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_58316743A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_58316743A76ED395 ON tuteurs (user_id)');
        $this->addSql('ALTER TABLE users ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9A76ED395 ON users (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs DROP FOREIGN KEY FK_90770F74A76ED395');
        $this->addSql('DROP INDEX IDX_90770F74A76ED395 ON blocs');
        $this->addSql('ALTER TABLE blocs DROP user_id');
        $this->addSql('ALTER TABLE entreprises DROP FOREIGN KEY FK_56B1B7A9A76ED395');
        $this->addSql('DROP INDEX IDX_56B1B7A9A76ED395 ON entreprises');
        $this->addSql('ALTER TABLE entreprises DROP user_id');
        $this->addSql('ALTER TABLE etudiants DROP FOREIGN KEY FK_227C02EBA76ED395');
        $this->addSql('DROP INDEX IDX_227C02EBA76ED395 ON etudiants');
        $this->addSql('ALTER TABLE etudiants DROP user_id');
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C0A76ED395');
        $this->addSql('DROP INDEX IDX_79A002C0A76ED395 ON intervenants');
        $this->addSql('ALTER TABLE intervenants DROP user_id');
        $this->addSql('ALTER TABLE modules DROP FOREIGN KEY FK_2EB743D7A76ED395');
        $this->addSql('DROP INDEX IDX_2EB743D7A76ED395 ON modules');
        $this->addSql('ALTER TABLE modules DROP user_id');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_58316743A76ED395');
        $this->addSql('DROP INDEX IDX_58316743A76ED395 ON tuteurs');
        $this->addSql('ALTER TABLE tuteurs DROP user_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A76ED395');
        $this->addSql('DROP INDEX IDX_1483A5E9A76ED395 ON users');
        $this->addSql('ALTER TABLE users DROP user_id');
    }
}
