<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180819175727 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, id_expediteur_id INT NOT NULL, id_destinataire_id INT NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, created DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_14E8F60CAE1B8E04 (id_expediteur_id), INDEX IDX_14E8F60C4DA68CE6 (id_destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CAE1B8E04 FOREIGN KEY (id_expediteur_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60C4DA68CE6 FOREIGN KEY (id_destinataire_id) REFERENCES membres (id)');
        $this->addSql('ALTER TABLE membres ADD role VARCHAR(48) NOT NULL, ADD mainimage VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(128) DEFAULT NULL, ADD naissance DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE messagerie');
        $this->addSql('ALTER TABLE membres DROP role, DROP mainimage, DROP ville, DROP naissance');
    }
}
