<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230101153354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE appartement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE depot_de_garantie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etats_des_lieux_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE images_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE locataire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE loyer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agence (id INT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, pourcentage VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE appartement (id INT NOT NULL, etats_des_lieux_id INT DEFAULT NULL, adresse VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, montantcharge VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_71A6BD8DADC35CB1 ON appartement (etats_des_lieux_id)');
        $this->addSql('CREATE TABLE depot_de_garantie (id INT NOT NULL, locataire_id INT DEFAULT NULL, montant VARCHAR(100) NOT NULL, datepaiement VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C345E99D8A38199 ON depot_de_garantie (locataire_id)');
        $this->addSql('CREATE TABLE etats_des_lieux (id INT NOT NULL, dateentree VARCHAR(100) NOT NULL, datesortie VARCHAR(100) NOT NULL, remarque VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE images (id INT NOT NULL, appartement_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E01FBE6AE1729BBA ON images (appartement_id)');
        $this->addSql('CREATE TABLE locataire (id INT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, adressse VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, solde VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C47CF6EB727ACA70 ON locataire (parent_id)');
        $this->addSql('CREATE TABLE loyer (id INT NOT NULL, agence_id INT NOT NULL, libelle VARCHAR(100) NOT NULL, montant VARCHAR(100) NOT NULL, datepaiement VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4045629D725330D ON loyer (agence_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, address VARCHAR(100) NOT NULL, zipcode VARCHAR(5) NOT NULL, city VARCHAR(100) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8DADC35CB1 FOREIGN KEY (etats_des_lieux_id) REFERENCES etats_des_lieux (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE depot_de_garantie ADD CONSTRAINT FK_C345E99D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AE1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EB727ACA70 FOREIGN KEY (parent_id) REFERENCES locataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loyer ADD CONSTRAINT FK_4045629D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE appartement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE depot_de_garantie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etats_des_lieux_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE images_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE locataire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE loyer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE appartement DROP CONSTRAINT FK_71A6BD8DADC35CB1');
        $this->addSql('ALTER TABLE depot_de_garantie DROP CONSTRAINT FK_C345E99D8A38199');
        $this->addSql('ALTER TABLE images DROP CONSTRAINT FK_E01FBE6AE1729BBA');
        $this->addSql('ALTER TABLE locataire DROP CONSTRAINT FK_C47CF6EB727ACA70');
        $this->addSql('ALTER TABLE loyer DROP CONSTRAINT FK_4045629D725330D');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE depot_de_garantie');
        $this->addSql('DROP TABLE etats_des_lieux');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE loyer');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
