<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180820121910 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, id_expediteur_id INT NOT NULL, id_destinataire_id INT NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, created DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_14E8F60CAE1B8E04 (id_expediteur_id), INDEX IDX_14E8F60C4DA68CE6 (id_destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CAE1B8E04 FOREIGN KEY (id_expediteur_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60C4DA68CE6 FOREIGN KEY (id_destinataire_id) REFERENCES membres (id)');
        $this->addSql('DROP TABLE membres_membres');
        $this->addSql('ALTER TABLE membres ADD trait_caractere VARCHAR(128) DEFAULT NULL, ADD type_relation VARCHAR(128) DEFAULT NULL, ADD taille INT DEFAULT NULL, ADD silhouette VARCHAR(128) DEFAULT NULL, ADD yeux VARCHAR(48) DEFAULT NULL, ADD cheveux VARCHAR(48) DEFAULT NULL, ADD fume VARCHAR(18) DEFAULT NULL, ADD mange VARCHAR(16) DEFAULT NULL, ADD jesuis VARCHAR(48) NOT NULL, CHANGE naissance naissance DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE membres_membres (id INT AUTO_INCREMENT NOT NULL, membrestarget_id INT NOT NULL, membressource_id INT NOT NULL, titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, message LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, dateheure DATETIME NOT NULL, INDEX IDX_FCA59B65FF8AEBC6 (membrestarget_id), INDEX IDX_FCA59B657F38FCC1 (membressource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membres_membres ADD CONSTRAINT FK_FCA59B657F38FCC1 FOREIGN KEY (membressource_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE membres_membres ADD CONSTRAINT FK_FCA59B65FF8AEBC6 FOREIGN KEY (membrestarget_id) REFERENCES membres (id)');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('ALTER TABLE membres DROP trait_caractere, DROP type_relation, DROP taille, DROP silhouette, DROP yeux, DROP cheveux, DROP fume, DROP mange, DROP jesuis, CHANGE naissance naissance DATE DEFAULT NULL');
    }
}
