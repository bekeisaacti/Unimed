<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902235130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE equipement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hospital_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medecin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE notification_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE patient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE referencement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_urgence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE specialte_medicale_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE equipement (id INT NOT NULL, hospital_id INT NOT NULL, name VARCHAR(255) NOT NULL, est_disponible BOOLEAN NOT NULL, quantite INT DEFAULT NULL, disponible INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B8B4C6F363DBB69 ON equipement (hospital_id)');
        $this->addSql('CREATE TABLE equipement_service_urgence (equipement_id INT NOT NULL, service_urgence_id INT NOT NULL, PRIMARY KEY(equipement_id, service_urgence_id))');
        $this->addSql('CREATE INDEX IDX_1EE548E806F0F5C ON equipement_service_urgence (equipement_id)');
        $this->addSql('CREATE INDEX IDX_1EE548EC1DA4609 ON equipement_service_urgence (service_urgence_id)');
        $this->addSql('CREATE TABLE hospital (id INT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(25) NOT NULL, email VARCHAR(150) NOT NULL, localisation VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE log (id INT NOT NULL, user_id_id INT NOT NULL, hospital_id INT NOT NULL, entity_name VARCHAR(50) NOT NULL, action VARCHAR(50) NOT NULL, field_name TEXT NOT NULL, old_value TEXT NOT NULL, new_value TEXT NOT NULL, motified_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, entity_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F3F68C59D86650F ON log (user_id_id)');
        $this->addSql('CREATE INDEX IDX_8F3F68C563DBB69 ON log (hospital_id)');
        $this->addSql('COMMENT ON COLUMN log.field_name IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN log.old_value IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN log.new_value IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE medecin (id INT NOT NULL, specialite_id INT NOT NULL, service_id INT NOT NULL, hospital_id INT NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(150) NOT NULL, telephone VARCHAR(25) NOT NULL, email VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1BDA53C62195E0F0 ON medecin (specialite_id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C6ED5CA9E6 ON medecin (service_id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C663DBB69 ON medecin (hospital_id)');
        $this->addSql('CREATE TABLE notification (id INT NOT NULL, hopital_id INT NOT NULL, transfert_id INT NOT NULL, message TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF5476CACC0FBF92 ON notification (hopital_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF5476CA3C9C4BAD ON notification (transfert_id)');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, service_id INT NOT NULL, hospital_id INT NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(150) NOT NULL, sexe VARCHAR(5) NOT NULL, adresse VARCHAR(150) NOT NULL, telephone VARCHAR(25) NOT NULL, email VARCHAR(150) NOT NULL, allergies TEXT NOT NULL, antecedents_medicaux TEXT NOT NULL, contact_urgence VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1ADAD7EBED5CA9E6 ON patient (service_id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB63DBB69 ON patient (hospital_id)');
        $this->addSql('CREATE TABLE referencement (id INT NOT NULL, patient_id INT NOT NULL, hospital_origine_id INT NOT NULL, hospital_destination_id INT NOT NULL, medecin_referent_id INT NOT NULL, service_origine_id INT NOT NULL, service_destination_id INT NOT NULL, date_ref TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, raisons TEXT NOT NULL, remarques TEXT NOT NULL, status TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83A125FE6B899279 ON referencement (patient_id)');
        $this->addSql('CREATE INDEX IDX_83A125FE7020909A ON referencement (hospital_origine_id)');
        $this->addSql('CREATE INDEX IDX_83A125FEE085C115 ON referencement (hospital_destination_id)');
        $this->addSql('CREATE INDEX IDX_83A125FE533AC932 ON referencement (medecin_referent_id)');
        $this->addSql('CREATE INDEX IDX_83A125FE96D6A03A ON referencement (service_origine_id)');
        $this->addSql('CREATE INDEX IDX_83A125FE820A3CF6 ON referencement (service_destination_id)');
        $this->addSql('COMMENT ON COLUMN referencement.date_ref IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE service_urgence (id INT NOT NULL, hospital_id INT NOT NULL, capacite INT NOT NULL, lits_occupes INT NOT NULL, lits_disponibles INT NOT NULL, nom VARCHAR(150) NOT NULL, description TEXT NOT NULL, telephone VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCF9395163DBB69 ON service_urgence (hospital_id)');
        $this->addSql('CREATE TABLE specialte_medicale (id INT NOT NULL, hospital_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3943C31863DBB69 ON specialte_medicale (hospital_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, hospital_id INT DEFAULT NULL, service_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(150) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D64963DBB69 ON "user" (hospital_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649ED5CA9E6 ON "user" (service_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F363DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipement_service_urgence ADD CONSTRAINT FK_1EE548E806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE equipement_service_urgence ADD CONSTRAINT FK_1EE548EC1DA4609 FOREIGN KEY (service_urgence_id) REFERENCES service_urgence (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C59D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C563DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C62195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialte_medicale (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service_urgence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C663DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CACC0FBF92 FOREIGN KEY (hopital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA3C9C4BAD FOREIGN KEY (transfert_id) REFERENCES referencement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBED5CA9E6 FOREIGN KEY (service_id) REFERENCES service_urgence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB63DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE referencement ADD CONSTRAINT FK_83A125FE6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE referencement ADD CONSTRAINT FK_83A125FE7020909A FOREIGN KEY (hospital_origine_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE referencement ADD CONSTRAINT FK_83A125FEE085C115 FOREIGN KEY (hospital_destination_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE referencement ADD CONSTRAINT FK_83A125FE533AC932 FOREIGN KEY (medecin_referent_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE referencement ADD CONSTRAINT FK_83A125FE96D6A03A FOREIGN KEY (service_origine_id) REFERENCES service_urgence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE referencement ADD CONSTRAINT FK_83A125FE820A3CF6 FOREIGN KEY (service_destination_id) REFERENCES service_urgence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_urgence ADD CONSTRAINT FK_BCF9395163DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE specialte_medicale ADD CONSTRAINT FK_3943C31863DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64963DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service_urgence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE equipement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hospital_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE log_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medecin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE notification_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE patient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE referencement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_urgence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE specialte_medicale_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE equipement DROP CONSTRAINT FK_B8B4C6F363DBB69');
        $this->addSql('ALTER TABLE equipement_service_urgence DROP CONSTRAINT FK_1EE548E806F0F5C');
        $this->addSql('ALTER TABLE equipement_service_urgence DROP CONSTRAINT FK_1EE548EC1DA4609');
        $this->addSql('ALTER TABLE log DROP CONSTRAINT FK_8F3F68C59D86650F');
        $this->addSql('ALTER TABLE log DROP CONSTRAINT FK_8F3F68C563DBB69');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C62195E0F0');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C6ED5CA9E6');
        $this->addSql('ALTER TABLE medecin DROP CONSTRAINT FK_1BDA53C663DBB69');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CACC0FBF92');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CA3C9C4BAD');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EBED5CA9E6');
        $this->addSql('ALTER TABLE patient DROP CONSTRAINT FK_1ADAD7EB63DBB69');
        $this->addSql('ALTER TABLE referencement DROP CONSTRAINT FK_83A125FE6B899279');
        $this->addSql('ALTER TABLE referencement DROP CONSTRAINT FK_83A125FE7020909A');
        $this->addSql('ALTER TABLE referencement DROP CONSTRAINT FK_83A125FEE085C115');
        $this->addSql('ALTER TABLE referencement DROP CONSTRAINT FK_83A125FE533AC932');
        $this->addSql('ALTER TABLE referencement DROP CONSTRAINT FK_83A125FE96D6A03A');
        $this->addSql('ALTER TABLE referencement DROP CONSTRAINT FK_83A125FE820A3CF6');
        $this->addSql('ALTER TABLE service_urgence DROP CONSTRAINT FK_BCF9395163DBB69');
        $this->addSql('ALTER TABLE specialte_medicale DROP CONSTRAINT FK_3943C31863DBB69');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64963DBB69');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649ED5CA9E6');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_service_urgence');
        $this->addSql('DROP TABLE hospital');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE referencement');
        $this->addSql('DROP TABLE service_urgence');
        $this->addSql('DROP TABLE specialte_medicale');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
