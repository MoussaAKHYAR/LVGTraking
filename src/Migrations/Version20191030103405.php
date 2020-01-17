<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030103405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accident (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_dinteret (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, INDEX IDX_970B9B914FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, immatriculation INT NOT NULL, maintenance TINYINT(1) NOT NULL, conso_km DOUBLE PRECISION NOT NULL, carburant_actuel DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_sortie (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, lieu_depart VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, nombre_litre INT NOT NULL, latitudedestination DOUBLE PRECISION NOT NULL, longitude_destination DOUBLE PRECISION NOT NULL, nombre_point INT NOT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_A0833C3E4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE point_dinteret ADD CONSTRAINT FK_970B9B914FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD CONSTRAINT FK_A0833C3E4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_de_sortie DROP FOREIGN KEY FK_A0833C3E4A4A3511');
        $this->addSql('ALTER TABLE point_dinteret DROP FOREIGN KEY FK_970B9B914FF6A66F');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE accident');
        $this->addSql('DROP TABLE point_dinteret');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE fiche_de_sortie');
    }
}
