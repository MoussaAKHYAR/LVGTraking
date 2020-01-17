<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030134825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rapport ADD fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C4FF6A66F ON rapport (fiche_de_sortie_id)');
        $this->addSql('ALTER TABLE fiche_de_sortie CHANGE vehicule_id vehicule_id INT DEFAULT NULL, CHANGE point_dinterets_id point_dinterets_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_de_sortie CHANGE point_dinterets_id point_dinterets_id INT DEFAULT NULL, CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C4FF6A66F');
        $this->addSql('DROP INDEX IDX_BE34A09C4FF6A66F ON rapport');
        $this->addSql('ALTER TABLE rapport DROP fiche_de_sortie_id');
    }
}
