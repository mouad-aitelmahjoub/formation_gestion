<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103104624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add relation between Stagiaires et Users tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stagiaires ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stagiaires ADD CONSTRAINT FK_4A9FADC6A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_4A9FADC6A76ED395 ON stagiaires (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stagiaires DROP FOREIGN KEY FK_4A9FADC6A76ED395');
        $this->addSql('DROP INDEX IDX_4A9FADC6A76ED395 ON stagiaires');
        $this->addSql('ALTER TABLE stagiaires DROP user_id');
    }
}
