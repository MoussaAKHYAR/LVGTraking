<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191115002849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_BE34A09C4FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, tel INT NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_17FD46C14A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE simulation (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, latitude_depart DOUBLE PRECISION NOT NULL, longitude_depart DOUBLE PRECISION NOT NULL, latitude_destination DOUBLE PRECISION NOT NULL, longitude_destination DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_CBDA467B4FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accident (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, INDEX IDX_8F31DB6F4FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, numero_serie VARCHAR(255) NOT NULL, date_dacquisition DATETIME NOT NULL, UNIQUE INDEX UNIQ_B8B4C6F34A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_dinteret (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, altitude DOUBLE PRECISION NOT NULL, INDEX IDX_462CE4F54FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, immatriculation INT NOT NULL, maintenance TINYINT(1) NOT NULL, conso_km DOUBLE PRECISION NOT NULL, carburant_actuel DOUBLE PRECISION NOT NULL, INDEX IDX_292FFF1D7A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, fiche_de_sortie_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_EDBFD5EC4FF6A66F (fiche_de_sortie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_sortie (id INT AUTO_INCREMENT NOT NULL, point_dinterets_id INT DEFAULT NULL, vehicule_id INT DEFAULT NULL, conducteur_id INT DEFAULT NULL, lieu_depart VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, nombre_litre INT NOT NULL, latitudedestination DOUBLE PRECISION NOT NULL, longitude_destination DOUBLE PRECISION NOT NULL, nombre_point INT NOT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_A0833C3EB8EBC2B0 (point_dinterets_id), INDEX IDX_A0833C3E4A4A3511 (vehicule_id), INDEX IDX_A0833C3EF16F4AC6 (conducteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C14A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE simulation ADD CONSTRAINT FK_CBDA467B4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE accident ADD CONSTRAINT FK_8F31DB6F4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F34A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F54FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC4FF6A66F FOREIGN KEY (fiche_de_sortie_id) REFERENCES fiche_de_sortie (id)');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD CONSTRAINT FK_A0833C3EB8EBC2B0 FOREIGN KEY (point_dinterets_id) REFERENCES point_dinteret (id)');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD CONSTRAINT FK_A0833C3E4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE fiche_de_sortie ADD CONSTRAINT FK_A0833C3EF16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche_de_sortie DROP FOREIGN KEY FK_A0833C3EF16F4AC6');
        $this->addSql('ALTER TABLE fiche_de_sortie DROP FOREIGN KEY FK_A0833C3EB8EBC2B0');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C14A4A3511');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F34A4A3511');
        $this->addSql('ALTER TABLE fiche_de_sortie DROP FOREIGN KEY FK_A0833C3E4A4A3511');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D7A45358C');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C4FF6A66F');
        $this->addSql('ALTER TABLE simulation DROP FOREIGN KEY FK_CBDA467B4FF6A66F');
        $this->addSql('ALTER TABLE accident DROP FOREIGN KEY FK_8F31DB6F4FF6A66F');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F54FF6A66F');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC4FF6A66F');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE simulation');
        $this->addSql('DROP TABLE accident');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE point_dinteret');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE fiche_de_sortie');
    }
}
