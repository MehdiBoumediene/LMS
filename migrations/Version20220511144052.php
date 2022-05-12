<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511144052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs ADD formations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blocs ADD CONSTRAINT FK_90770F743BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_90770F743BF5B0C2 ON blocs (formations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs DROP FOREIGN KEY FK_90770F743BF5B0C2');
        $this->addSql('DROP INDEX IDX_90770F743BF5B0C2 ON blocs');
        $this->addSql('ALTER TABLE blocs DROP formations_id');
    }
}
