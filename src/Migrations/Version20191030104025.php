<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030104025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE point_dinteret DROP FOREIGN KEY FK_970B9B914FF6A66F');
        $this->addSql('DROP INDEX IDX_970B9B914FF6A66F ON point_dinteret');
        $this->addSql('ALTER TABLE point_dinteret DROP fiche_de_sortie_id');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD point_dinterets_id INT DEFAULT NULL, CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD CONSTRAINT FK_A0833C3EB8EBC2B0 FOREIGN KEY (point_dinterets_id) REFERENCES point_dinteret (id)');
        $this->addSql('CREATE INDEX IDX_A0833C3EB8EBC2B0 ON fiche_de_sortie (point_dinterets_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_de_sortie DROP FOREIGN KEY FK_A0833C3EB8EBC2B0');
        $this->addSql('DROP INDEX IDX_A0833C3EB8EBC2B0 ON fiche_de_sortie');
        $this->addSql('ALTER TABLE fiche_de_sortie DROP point_dinterets_id, CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point_dinteret ADD fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point_dinteret ADD CONSTRAINT FK_970B9B914FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('CREATE INDEX IDX_970B9B914FF6A66F ON point_dinteret (fiche_de_sortie_id)');
    }
}
