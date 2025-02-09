<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250207144029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Adh_Inscription (annee INT NOT NULL, id_adh INT NOT NULL, bulletin_adh VARCHAR(255) DEFAULT NULL, certif_adh VARCHAR(255) DEFAULT NULL, attestation_ce_adh TINYINT(1) DEFAULT 0 NOT NULL, dt_inscription_adh DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', formule_adh VARCHAR(4) DEFAULT NULL, nb_renew_card_adh INT DEFAULT 0 NOT NULL, mode_paiement_adh VARCHAR(3) DEFAULT NULL, remise_adh DOUBLE PRECISION DEFAULT \'0\' NOT NULL, montant_total_adh DOUBLE PRECISION DEFAULT NULL, montant_paye_adh DOUBLE PRECISION DEFAULT \'0\' NOT NULL, caution_adh DOUBLE PRECISION DEFAULT NULL, is_paye_adh TINYINT(1) DEFAULT 0 NOT NULL, note_adh LONGTEXT DEFAULT NULL, INDEX IDX_9836A7E36A08D796 (id_adh), PRIMARY KEY(annee)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Adh_Inscription_Paiement (annee INT NOT NULL, num_ch_adh INT NOT NULL, banque_ch_adh VARCHAR(100) DEFAULT NULL, date_ch_adh DATE NOT NULL, montant_ch_adh NUMERIC(6, 2) NOT NULL, is_paid TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(annee, num_ch_adh)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Admins (id_adm INT AUTO_INCREMENT NOT NULL, nom_adm VARCHAR(100) NOT NULL, prenom_adm VARCHAR(100) NOT NULL, signature_adm VARCHAR(255) DEFAULT NULL, index_adm VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_A54C1039D523C16C (index_adm), PRIMARY KEY(id_adm)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Alertes (id_alt INT AUTO_INCREMENT NOT NULL, admin_index_alt INT NOT NULL, prof_index_alt INT DEFAULT NULL, adh_index_alt INT DEFAULT NULL, dt_alt DATE NOT NULL, type_alt VARCHAR(20) NOT NULL, statut_alt VARCHAR(1) DEFAULT \'N\' NOT NULL, hide_alt TINYINT(1) DEFAULT 0 NOT NULL, origine_alt VARCHAR(255) NOT NULL, INDEX IDX_12BC81509066E696 (admin_index_alt), INDEX IDX_12BC8150D45C8680 (prof_index_alt), INDEX IDX_12BC8150CAD54F9C (adh_index_alt), PRIMARY KEY(id_alt)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Cours (id_cours INT AUTO_INCREMENT NOT NULL, id_salle INT NOT NULL, id_prof INT NOT NULL, id_discipline INT NOT NULL, annee_cours INT NOT NULL, jour_cours INT NOT NULL, heure_cours INT NOT NULL, duree_cours INT NOT NULL, age_min_cours INT DEFAULT NULL, age_max_cours INT DEFAULT NULL, is_active TINYINT(1) DEFAULT 0 NOT NULL, is_full TINYINT(1) DEFAULT 0 NOT NULL, is_populated TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_3C0BA398A0123F6C (id_salle), INDEX IDX_3C0BA398D09A6CB9 (id_prof), INDEX IDX_3C0BA398D0346EE8 (id_discipline), PRIMARY KEY(id_cours)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Disciplines (id_discipline INT AUTO_INCREMENT NOT NULL, nom_discipline VARCHAR(100) NOT NULL, description_discipline LONGTEXT DEFAULT NULL, photo_discipline VARCHAR(255) DEFAULT NULL, video_discipline VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_2B81D30F74F16E48 (nom_discipline), PRIMARY KEY(id_discipline)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Evenements (id_evt INT AUTO_INCREMENT NOT NULL, id_prof_evt INT NOT NULL, id_cours_evt INT NOT NULL, nom_evt VARCHAR(255) DEFAULT NULL, description_evt LONGTEXT DEFAULT NULL, type_evt LONGTEXT NOT NULL, `integer` INT NOT NULL, motif_evt VARCHAR(7) DEFAULT NULL, debut_evt DATETIME NOT NULL, fin_evt DATETIME NOT NULL, INDEX IDX_AE57D7D0FEF12166 (id_prof_evt), INDEX IDX_AE57D7D0BFAE13CC (id_cours_evt), PRIMARY KEY(id_evt)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Evt_Presence (id_evt INT NOT NULL, id_adh INT NOT NULL, INDEX IDX_62E84FE01F453D6 (id_evt), INDEX FK_EVT_PRESENCE_ID_ADH (id_adh), UNIQUE INDEX evt_presence_unique (id_evt, id_adh), PRIMARY KEY(id_evt, id_adh)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Profs (id_prof INT AUTO_INCREMENT NOT NULL, nom_prof VARCHAR(100) NOT NULL, prenom_prof VARCHAR(100) NOT NULL, tel_prof VARCHAR(20) NOT NULL, email_prof VARCHAR(255) NOT NULL, tel2_prof VARCHAR(20) DEFAULT NULL, photo_prof VARCHAR(255) DEFAULT NULL, presentation_prof LONGTEXT DEFAULT NULL, index_prof VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8627307BF03AA8E8 (index_prof), PRIMARY KEY(id_prof)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Salles (id_salle INT AUTO_INCREMENT NOT NULL, nom_salle VARCHAR(100) NOT NULL, quota_salle INT DEFAULT NULL, adr_salle VARCHAR(200) NOT NULL, cp_salle INT NOT NULL, ville_salle VARCHAR(100) NOT NULL, indication_salle VARCHAR(150) DEFAULT NULL, carte_salle VARCHAR(255) DEFAULT NULL, photo_salle VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_7E31409CE46FE2C9 (nom_salle), PRIMARY KEY(id_salle)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Setting (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, active_year INT NOT NULL, UNIQUE INDEX UNIQ_50C98104E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Users (id_user INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USER_NAME (user_name), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adh_cours (id_adh INT NOT NULL, id_cours INT NOT NULL, INDEX IDX_87D9EC296A08D796 (id_adh), INDEX IDX_87D9EC29134FCDAC (id_cours), PRIMARY KEY(id_adh, id_cours)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adherents (id_adh INT AUTO_INCREMENT NOT NULL, id_users INT DEFAULT NULL, nom_adh VARCHAR(100) NOT NULL, prenom_adh VARCHAR(100) NOT NULL, rep_legal_adh VARCHAR(200) DEFAULT NULL, sexe_adh VARCHAR(1) DEFAULT \'F\' NOT NULL, email_adh VARCHAR(250) NOT NULL, email2_adh VARCHAR(250) DEFAULT NULL, tel_adh VARCHAR(20) NOT NULL, tel2_adh VARCHAR(20) DEFAULT NULL, adr_adh VARCHAR(200) NOT NULL, cp_adh INT NOT NULL, ville_adh VARCHAR(100) NOT NULL, dt_naissance_adh DATE NOT NULL, photo_adh VARCHAR(255) DEFAULT NULL, pass_sanitaire_adh VARCHAR(4) DEFAULT NULL, index_adh VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_562C7DA3FA06E4D9 (id_users), PRIMARY KEY(id_adh)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formule_inscription (annee INT NOT NULL, code_f VARCHAR(4) NOT NULL, libelle_f VARCHAR(100) NOT NULL, tarif_f INT NOT NULL, tarif_renew INT DEFAULT NULL, age_min_f INT DEFAULT NULL, age_max_f INT DEFAULT NULL, UNIQUE INDEX UNIQ_46B8343B476AD0A2 (code_f), PRIMARY KEY(annee, code_f)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Adh_Inscription ADD CONSTRAINT FK_9836A7E36A08D796 FOREIGN KEY (id_adh) REFERENCES adherents (id_adh)');
        $this->addSql('ALTER TABLE Alertes ADD CONSTRAINT FK_12BC81509066E696 FOREIGN KEY (admin_index_alt) REFERENCES Admins (id_adm)');
        $this->addSql('ALTER TABLE Alertes ADD CONSTRAINT FK_12BC8150D45C8680 FOREIGN KEY (prof_index_alt) REFERENCES Profs (id_prof)');
        $this->addSql('ALTER TABLE Alertes ADD CONSTRAINT FK_12BC8150CAD54F9C FOREIGN KEY (adh_index_alt) REFERENCES adherents (id_adh)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398A0123F6C FOREIGN KEY (id_salle) REFERENCES Salles (id_salle)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398D09A6CB9 FOREIGN KEY (id_prof) REFERENCES Profs (id_prof)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398D0346EE8 FOREIGN KEY (id_discipline) REFERENCES Disciplines (id_discipline)');
        $this->addSql('ALTER TABLE Evenements ADD CONSTRAINT FK_AE57D7D0FEF12166 FOREIGN KEY (id_prof_evt) REFERENCES Profs (id_prof)');
        $this->addSql('ALTER TABLE Evenements ADD CONSTRAINT FK_AE57D7D0BFAE13CC FOREIGN KEY (id_cours_evt) REFERENCES Cours (id_cours) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE Evt_Presence ADD CONSTRAINT FK_62E84FE01F453D6 FOREIGN KEY (id_evt) REFERENCES Evenements (id_evt)');
        $this->addSql('ALTER TABLE Evt_Presence ADD CONSTRAINT FK_62E84FE06A08D796 FOREIGN KEY (id_adh) REFERENCES adherents (id_adh)');
        $this->addSql('ALTER TABLE adh_cours ADD CONSTRAINT FK_87D9EC296A08D796 FOREIGN KEY (id_adh) REFERENCES adherents (id_adh) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adh_cours ADD CONSTRAINT FK_87D9EC29134FCDAC FOREIGN KEY (id_cours) REFERENCES Cours (id_cours) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adherents ADD CONSTRAINT FK_562C7DA3FA06E4D9 FOREIGN KEY (id_users) REFERENCES Users (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Adh_Inscription DROP FOREIGN KEY FK_9836A7E36A08D796');
        $this->addSql('ALTER TABLE Alertes DROP FOREIGN KEY FK_12BC81509066E696');
        $this->addSql('ALTER TABLE Alertes DROP FOREIGN KEY FK_12BC8150D45C8680');
        $this->addSql('ALTER TABLE Alertes DROP FOREIGN KEY FK_12BC8150CAD54F9C');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398A0123F6C');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398D09A6CB9');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398D0346EE8');
        $this->addSql('ALTER TABLE Evenements DROP FOREIGN KEY FK_AE57D7D0FEF12166');
        $this->addSql('ALTER TABLE Evenements DROP FOREIGN KEY FK_AE57D7D0BFAE13CC');
        $this->addSql('ALTER TABLE Evt_Presence DROP FOREIGN KEY FK_62E84FE01F453D6');
        $this->addSql('ALTER TABLE Evt_Presence DROP FOREIGN KEY FK_62E84FE06A08D796');
        $this->addSql('ALTER TABLE adh_cours DROP FOREIGN KEY FK_87D9EC296A08D796');
        $this->addSql('ALTER TABLE adh_cours DROP FOREIGN KEY FK_87D9EC29134FCDAC');
        $this->addSql('ALTER TABLE adherents DROP FOREIGN KEY FK_562C7DA3FA06E4D9');
        $this->addSql('DROP TABLE Adh_Inscription');
        $this->addSql('DROP TABLE Adh_Inscription_Paiement');
        $this->addSql('DROP TABLE Admins');
        $this->addSql('DROP TABLE Alertes');
        $this->addSql('DROP TABLE Cours');
        $this->addSql('DROP TABLE Disciplines');
        $this->addSql('DROP TABLE Evenements');
        $this->addSql('DROP TABLE Evt_Presence');
        $this->addSql('DROP TABLE Profs');
        $this->addSql('DROP TABLE Salles');
        $this->addSql('DROP TABLE Setting');
        $this->addSql('DROP TABLE Users');
        $this->addSql('DROP TABLE adh_cours');
        $this->addSql('DROP TABLE adherents');
        $this->addSql('DROP TABLE formule_inscription');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
