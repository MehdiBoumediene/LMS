<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511141804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE couvertures ADD formations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE couvertures ADD CONSTRAINT FK_1B72DAD63BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('CREATE INDEX IDX_1B72DAD63BF5B0C2 ON couvertures (formations_id)');
        $this->addSql('ALTER TABLE leschapitres ADD lesmodules_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE leschapitres ADD CONSTRAINT FK_DCFF8E55CF50BEF9 FOREIGN KEY (lesmodules_id) REFERENCES lesmodules (id)');
        $this->addSql('CREATE INDEX IDX_DCFF8E55CF50BEF9 ON leschapitres (lesmodules_id)');
        $this->addSql('ALTER TABLE lesmodules DROP FOREIGN KEY FK_AFA142B9843473FF');
        $this->addSql('DROP INDEX IDX_AFA142B9843473FF ON lesmodules');
        $this->addSql('ALTER TABLE lesmodules DROP leschapitres_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE couvertures DROP FOREIGN KEY FK_1B72DAD63BF5B0C2');
        $this->addSql('DROP INDEX IDX_1B72DAD63BF5B0C2 ON couvertures');
        $this->addSql('ALTER TABLE couvertures DROP formations_id');
        $this->addSql('ALTER TABLE leschapitres DROP FOREIGN KEY FK_DCFF8E55CF50BEF9');
        $this->addSql('DROP INDEX IDX_DCFF8E55CF50BEF9 ON leschapitres');
        $this->addSql('ALTER TABLE leschapitres DROP lesmodules_id');
        $this->addSql('ALTER TABLE lesmodules ADD leschapitres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesmodules ADD CONSTRAINT FK_AFA142B9843473FF FOREIGN KEY (leschapitres_id) REFERENCES leschapitres (id)');
        $this->addSql('CREATE INDEX IDX_AFA142B9843473FF ON lesmodules (leschapitres_id)');
    }
}
