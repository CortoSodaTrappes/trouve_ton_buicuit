<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180816075626 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE membres (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, email VARCHAR(80) NOT NULL, password VARCHAR(80) NOT NULL, role VARCHAR(48) NOT NULL, mainimage VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, id_expediteur_id INT NOT NULL, id_destinataire_id INT NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, created DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_14E8F60CAE1B8E04 (id_expediteur_id), INDEX IDX_14E8F60C4DA68CE6 (id_destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentations (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, presentation VARCHAR(128) NOT NULL, type_personne VARCHAR(50) NOT NULL, type_relation VARCHAR(50) NOT NULL, INDEX IDX_72936B1DEAAC4B6D (id_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recherches (id INT AUTO_INCREMENT NOT NULL, id_membre_id INT NOT NULL, type_personne VARCHAR(48) NOT NULL, type_relation VARCHAR(48) NOT NULL, titre_recherche VARCHAR(128) NOT NULL, INDEX IDX_84050CB5EAAC4B6D (id_membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CAE1B8E04 FOREIGN KEY (id_expediteur_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60C4DA68CE6 FOREIGN KEY (id_destinataire_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE presentations ADD CONSTRAINT FK_72936B1DEAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE recherches ADD CONSTRAINT FK_84050CB5EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membres (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60CAE1B8E04');
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60C4DA68CE6');
        $this->addSql('ALTER TABLE presentations DROP FOREIGN KEY FK_72936B1DEAAC4B6D');
        $this->addSql('ALTER TABLE recherches DROP FOREIGN KEY FK_84050CB5EAAC4B6D');
        $this->addSql('DROP TABLE membres');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE presentations');
        $this->addSql('DROP TABLE recherches');
    }
}
