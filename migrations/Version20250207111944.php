<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207111944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adherents DROP FOREIGN KEY FK_562C7DA3FA06E4D9');
        $this->addSql('CREATE TABLE Emails (id_email INT AUTO_INCREMENT NOT NULL, from_email VARCHAR(255) NOT NULL, from_adhindex_email VARCHAR(30) DEFAULT NULL, from_prof_index_email VARCHAR(30) DEFAULT NULL, to_email LONGTEXT NOT NULL, to_type_email VARCHAR(8) NOT NULL, adh_index_email VARCHAR(30) DEFAULT NULL, prof_index_email VARCHAR(30) DEFAULT NULL, cours_id_email VARCHAR(30) DEFAULT NULL, to_name_email VARCHAR(255) NOT NULL, dt_email DATETIME NOT NULL, subject_email LONGTEXT NOT NULL, content_email LONGTEXT NOT NULL, PRIMARY KEY(id_email)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(50) NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (user_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adh_cours DROP FOREIGN KEY FK_87D9EC29134FCDAC');
        $this->addSql('ALTER TABLE adh_cours DROP FOREIGN KEY FK_87D9EC296A08D796');
        $this->addSql('ALTER TABLE Evt_Presence DROP FOREIGN KEY FK_62E84FE01F453D6');
        $this->addSql('ALTER TABLE Evt_Presence DROP FOREIGN KEY FK_62E84FE06A08D796');
        $this->addSql('DROP TABLE adh_cours');
        $this->addSql('DROP TABLE Evt_Presence');
        $this->addSql('DROP TABLE Users');
        $this->addSql('ALTER TABLE Adh_Inscription DROP FOREIGN KEY FK_9836A7E36A08D796');
        $this->addSql('DROP INDEX IDX_9836A7E36A08D796 ON Adh_Inscription');
        $this->addSql('ALTER TABLE Adh_Inscription DROP id_adh, CHANGE remise_adh remise_adh NUMERIC(6, 2) DEFAULT \'0\' NOT NULL, CHANGE montant_total_adh montant_total_adh NUMERIC(6, 2) DEFAULT NULL, CHANGE montant_paye_adh montant_paye_adh NUMERIC(6, 2) DEFAULT \'0\' NOT NULL, CHANGE caution_adh caution_adh NUMERIC(6, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE Adh_Inscription_Paiement ADD id_adh INT NOT NULL');
        $this->addSql('ALTER TABLE Adh_Inscription_Paiement ADD CONSTRAINT FK_FFDF0AD56A08D796 FOREIGN KEY (id_adh) REFERENCES Adherents (id_adh)');
        $this->addSql('CREATE INDEX IDX_FFDF0AD56A08D796 ON Adh_Inscription_Paiement (id_adh)');
        $this->addSql('DROP INDEX UNIQ_562C7DA3FA06E4D9 ON adherents');
        $this->addSql('ALTER TABLE adherents DROP id_users');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398A0123F6C');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398D0346EE8');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398D09A6CB9');
        $this->addSql('DROP INDEX IDX_3C0BA398A0123F6C ON Cours');
        $this->addSql('DROP INDEX IDX_3C0BA398D0346EE8 ON Cours');
        $this->addSql('DROP INDEX IDX_3C0BA398D09A6CB9 ON Cours');
        $this->addSql('ALTER TABLE Cours DROP id_salle, DROP id_prof, DROP id_discipline, CHANGE heure_cours heure_cours VARCHAR(5) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_46B8343B476AD0A2 ON formule_inscription');
        $this->addSql('ALTER TABLE Evenements DROP FOREIGN KEY FK_AE57D7D0BFAE13CC');
        $this->addSql('ALTER TABLE Evenements DROP FOREIGN KEY FK_AE57D7D0FEF12166');
        $this->addSql('DROP INDEX IDX_AE57D7D0BFAE13CC ON Evenements');
        $this->addSql('DROP INDEX IDX_AE57D7D0FEF12166 ON Evenements');
        $this->addSql('ALTER TABLE Evenements ADD statut_evt INT NOT NULL, DROP id_prof_evt, DROP id_cours_evt, DROP `integer`, CHANGE type_evt type_evt VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adh_cours (id_adh INT NOT NULL, id_cours INT NOT NULL, INDEX IDX_87D9EC29134FCDAC (id_cours), INDEX IDX_87D9EC296A08D796 (id_adh), PRIMARY KEY(id_adh, id_cours)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Evt_Presence (id_evt INT NOT NULL, id_adh INT NOT NULL, UNIQUE INDEX evt_presence_unique (id_evt, id_adh), INDEX FK_EVT_PRESENCE_ID_ADH (id_adh), INDEX IDX_62E84FE01F453D6 (id_evt), PRIMARY KEY(id_evt, id_adh)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Users (id_user INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_active TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USER_NAME (user_name), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adh_cours ADD CONSTRAINT FK_87D9EC29134FCDAC FOREIGN KEY (id_cours) REFERENCES Cours (id_cours) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adh_cours ADD CONSTRAINT FK_87D9EC296A08D796 FOREIGN KEY (id_adh) REFERENCES adherents (id_adh) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Evt_Presence ADD CONSTRAINT FK_62E84FE01F453D6 FOREIGN KEY (id_evt) REFERENCES Evenements (id_evt) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Evt_Presence ADD CONSTRAINT FK_62E84FE06A08D796 FOREIGN KEY (id_adh) REFERENCES adherents (id_adh) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE Emails');
        $this->addSql('DROP TABLE User');
        $this->addSql('ALTER TABLE Adh_Inscription ADD id_adh INT NOT NULL, CHANGE remise_adh remise_adh DOUBLE PRECISION DEFAULT \'0\' NOT NULL, CHANGE montant_total_adh montant_total_adh DOUBLE PRECISION DEFAULT NULL, CHANGE montant_paye_adh montant_paye_adh DOUBLE PRECISION DEFAULT \'0\' NOT NULL, CHANGE caution_adh caution_adh DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE Adh_Inscription ADD CONSTRAINT FK_9836A7E36A08D796 FOREIGN KEY (id_adh) REFERENCES adherents (id_adh) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9836A7E36A08D796 ON Adh_Inscription (id_adh)');
        $this->addSql('ALTER TABLE Adh_Inscription_Paiement DROP FOREIGN KEY FK_FFDF0AD56A08D796');
        $this->addSql('DROP INDEX IDX_FFDF0AD56A08D796 ON Adh_Inscription_Paiement');
        $this->addSql('ALTER TABLE Adh_Inscription_Paiement DROP id_adh');
        $this->addSql('ALTER TABLE Adherents ADD id_users INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Adherents ADD CONSTRAINT FK_562C7DA3FA06E4D9 FOREIGN KEY (id_users) REFERENCES Users (id_user) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_562C7DA3FA06E4D9 ON Adherents (id_users)');
        $this->addSql('ALTER TABLE Cours ADD id_salle INT NOT NULL, ADD id_prof INT NOT NULL, ADD id_discipline INT NOT NULL, CHANGE heure_cours heure_cours INT NOT NULL');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398A0123F6C FOREIGN KEY (id_salle) REFERENCES Salles (id_salle) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398D0346EE8 FOREIGN KEY (id_discipline) REFERENCES Disciplines (id_discipline) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398D09A6CB9 FOREIGN KEY (id_prof) REFERENCES Profs (id_prof) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C0BA398A0123F6C ON Cours (id_salle)');
        $this->addSql('CREATE INDEX IDX_3C0BA398D0346EE8 ON Cours (id_discipline)');
        $this->addSql('CREATE INDEX IDX_3C0BA398D09A6CB9 ON Cours (id_prof)');
        $this->addSql('ALTER TABLE evenements ADD id_cours_evt INT NOT NULL, ADD `integer` INT NOT NULL, CHANGE type_evt type_evt LONGTEXT NOT NULL, CHANGE statut_evt id_prof_evt INT NOT NULL');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_AE57D7D0BFAE13CC FOREIGN KEY (id_cours_evt) REFERENCES Cours (id_cours) ON UPDATE NO ACTION');
        $this->addSql('ALTER TABLE evenements ADD CONSTRAINT FK_AE57D7D0FEF12166 FOREIGN KEY (id_prof_evt) REFERENCES Profs (id_prof) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AE57D7D0BFAE13CC ON evenements (id_cours_evt)');
        $this->addSql('CREATE INDEX IDX_AE57D7D0FEF12166 ON evenements (id_prof_evt)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46B8343B476AD0A2 ON Formule_Inscription (code_f)');
    }
}
