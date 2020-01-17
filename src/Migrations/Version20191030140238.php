<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030140238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE simulation (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, latitude_depart DOUBLE PRECISION NOT NULL, longitude_depart DOUBLE PRECISION NOT NULL, latitude_destination DOUBLE PRECISION NOT NULL, longitude_destination DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_CBDA467B4FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, altitude DOUBLE PRECISION NOT NULL, INDEX IDX_462CE4F54FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE simulation ADD CONSTRAINT FK_CBDA467B4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F54FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE rapport CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert ADD vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C14A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('CREATE INDEX IDX_17FD46C14A4A3511 ON alert (vehicule_id)');
        $this->addSql('ALTER TABLE accident ADD fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accident ADD CONSTRAINT FK_8F31DB6F4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('CREATE INDEX IDX_8F31DB6F4FF6A66F ON accident (fiche_de_sortie_id)');
        $this->addSql('ALTER TABLE historique ADD fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('CREATE INDEX IDX_EDBFD5EC4FF6A66F ON historique (fiche_de_sortie_id)');
        $this->addSql('ALTER TABLE fiche_de_sortie CHANGE vehicule_id vehicule_id INT DEFAULT NULL, CHANGE point_dinterets_id point_dinterets_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE simulation');
        $this->addSql('DROP TABLE position');
        $this->addSql('ALTER TABLE accident DROP FOREIGN KEY FK_8F31DB6F4FF6A66F');
        $this->addSql('DROP INDEX IDX_8F31DB6F4FF6A66F ON accident');
        $this->addSql('ALTER TABLE accident DROP fiche_de_sortie_id');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C14A4A3511');
        $this->addSql('DROP INDEX IDX_17FD46C14A4A3511 ON alert');
        $this->addSql('ALTER TABLE alert DROP vehicule_id');
        $this->addSql('ALTER TABLE fiche_de_sortie CHANGE point_dinterets_id point_dinterets_id INT DEFAULT NULL, CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC4FF6A66F');
        $this->addSql('DROP INDEX IDX_EDBFD5EC4FF6A66F ON historique');
        $this->addSql('ALTER TABLE historique DROP fiche_de_sortie_id');
        $this->addSql('ALTER TABLE rapport CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
    }
}
