<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030141504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, tel INT NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, numero_serie VARCHAR(255) NOT NULL, date_dacquisition DATETIME NOT NULL, UNIQUE INDEX UNIQ_B8B4C6F34A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F34A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE rapport CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE simulation CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accident CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE position CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD groupe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1D7A45358C ON vehicule (groupe_id)');
        $this->addSql('ALTER TABLE historique CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD conducteur_id INT DEFAULT NULL, CHANGE vehicule_id vehicule_id INT DEFAULT NULL, CHANGE point_dinterets_id point_dinterets_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD CONSTRAINT FK_A0833C3EF16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('CREATE INDEX IDX_A0833C3EF16F4AC6 ON fiche_de_sortie (conducteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_de_sortie DROP FOREIGN KEY FK_A0833C3EF16F4AC6');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D7A45358C');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('ALTER TABLE accident CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_A0833C3EF16F4AC6 ON fiche_de_sortie');
        $this->addSql('ALTER TABLE fiche_de_sortie DROP conducteur_id, CHANGE point_dinterets_id point_dinterets_id INT DEFAULT NULL, CHANGE vehicule_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE position CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE simulation CHANGE fiche_de_sortie_id fiche_de_sortie_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_292FFF1D7A45358C ON vehicule');
        $this->addSql('ALTER TABLE vehicule DROP groupe_id');
    }
}
