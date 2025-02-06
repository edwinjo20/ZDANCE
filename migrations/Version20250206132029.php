<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206132029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Cours (id_cours INT AUTO_INCREMENT NOT NULL, id_salle INT NOT NULL, id_prof INT NOT NULL, id_discipline INT NOT NULL, annee_cours INT NOT NULL, jour_cours INT NOT NULL, heure_cours INT NOT NULL, duree_cours INT NOT NULL, age_min_cours INT DEFAULT NULL, age_max_cours INT DEFAULT NULL, is_active TINYINT(1) DEFAULT 0 NOT NULL, is_full TINYINT(1) DEFAULT 0 NOT NULL, is_populated TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_3C0BA398A0123F6C (id_salle), INDEX IDX_3C0BA398D09A6CB9 (id_prof), INDEX IDX_3C0BA398D0346EE8 (id_discipline), PRIMARY KEY(id_cours)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398A0123F6C FOREIGN KEY (id_salle) REFERENCES Salles (id_salle)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398D09A6CB9 FOREIGN KEY (id_prof) REFERENCES Profs (id_prof)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398D0346EE8 FOREIGN KEY (id_discipline) REFERENCES Disciplines (id_discipline)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398A0123F6C');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398D09A6CB9');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398D0346EE8');
        $this->addSql('DROP TABLE Cours');
    }
}
