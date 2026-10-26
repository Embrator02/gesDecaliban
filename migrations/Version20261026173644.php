<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261026173644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campagn (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, montant INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, telephone VARCHAR(9) NOT NULL, date_naiss DATE NOT NULL, fonctionnalite VARCHAR(100) NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_F6B4FB29A76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE mode_de_cotisation (id INT AUTO_INCREMENT NOT NULL, islibre TINYINT NOT NULL, montant NUMERIC(5, 2) NOT NULL, date_vrsmnt DATETIME NOT NULL, membre_id INT NOT NULL, campagn_id INT NOT NULL, INDEX IDX_F359D1876A99F74A (membre_id), INDEX IDX_F359D1879F87CC13 (campagn_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pret (id INT AUTO_INCREMENT NOT NULL, date_pret DATETIME NOT NULL, montant INT NOT NULL, date_rbrsmt DATE NOT NULL, pret_statut VARCHAR(255) DEFAULT NULL, membre VARCHAR(255) NOT NULL, membres_id INT DEFAULT NULL, INDEX IDX_52ECE97971128C5C (membres_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(100) NOT NULL, passwrd VARCHAR(100) NOT NULL, roles JSON NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mode_de_cotisation ADD CONSTRAINT FK_F359D1876A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE mode_de_cotisation ADD CONSTRAINT FK_F359D1879F87CC13 FOREIGN KEY (campagn_id) REFERENCES campagn (id)');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE97971128C5C FOREIGN KEY (membres_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29A76ED395');
        $this->addSql('ALTER TABLE mode_de_cotisation DROP FOREIGN KEY FK_F359D1876A99F74A');
        $this->addSql('ALTER TABLE mode_de_cotisation DROP FOREIGN KEY FK_F359D1879F87CC13');
        $this->addSql('ALTER TABLE pret DROP FOREIGN KEY FK_52ECE97971128C5C');
        $this->addSql('DROP TABLE campagn');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE mode_de_cotisation');
        $this->addSql('DROP TABLE pret');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
