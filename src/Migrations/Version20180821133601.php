<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821133601 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membres ADD trait_caractere VARCHAR(128) DEFAULT NULL, ADD type_relation VARCHAR(128) DEFAULT NULL, ADD taille VARCHAR(16) DEFAULT NULL, ADD silhouette VARCHAR(128) DEFAULT NULL, ADD yeux VARCHAR(48) DEFAULT NULL, ADD cheveux VARCHAR(48) DEFAULT NULL, ADD fume VARCHAR(18) DEFAULT NULL, ADD mange VARCHAR(16) DEFAULT NULL, ADD jesuis VARCHAR(48) NOT NULL, ADD jeveux VARCHAR(128) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD punchline VARCHAR(255) DEFAULT NULL, ADD animaux VARCHAR(64) DEFAULT NULL, ADD hobby VARCHAR(64) DEFAULT NULL, ADD statut VARCHAR(64) DEFAULT NULL, CHANGE naissance naissance DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membres DROP trait_caractere, DROP type_relation, DROP taille, DROP silhouette, DROP yeux, DROP cheveux, DROP fume, DROP mange, DROP jesuis, DROP jeveux, DROP description, DROP punchline, DROP animaux, DROP hobby, DROP statut, CHANGE naissance naissance DATE DEFAULT NULL');
    }
}
