<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022091016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Stagiaires table with the initial set of fields';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stagiaires (id INT AUTO_INCREMENT NOT NULL, situation VARCHAR(255) NOT NULL, nom_famille VARCHAR(255) NOT NULL, nom_naissance VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mobile INT NOT NULL, fixe INT NOT NULL, adresse VARCHAR(255) NOT NULL, birthday DATE NOT NULL, sociale VARCHAR(255) NOT NULL, diplome VARCHAR(255) NOT NULL, emploi VARCHAR(255) NOT NULL, n_dossier VARCHAR(255) NOT NULL, formation VARCHAR(255) NOT NULL, temps_libre VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stagiaires');
    }
}
