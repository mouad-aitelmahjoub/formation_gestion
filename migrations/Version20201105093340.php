<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105093340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add 3 last fields to the Stagiaire table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stagiaires ADD rdv_formateur DATETIME NOT NULL, ADD fond_disponible DOUBLE PRECISION NOT NULL, ADD prix_formation DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stagiaires DROP rdv_formateur, DROP fond_disponible, DROP prix_formation');
    }
}
