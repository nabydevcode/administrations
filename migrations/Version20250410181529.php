<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410181529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE company (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE consigne (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE delivery_location (id SERIAL NOT NULL, place VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE loading_locations (id SERIAL NOT NULL, place VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE shipment (id SERIAL NOT NULL, company_id INT DEFAULT NULL, consigne_id INT DEFAULT NULL, delivery_location_id INT DEFAULT NULL, loading_location_id INT DEFAULT NULL, transporteur_id INT DEFAULT NULL, type_loading_id INT DEFAULT NULL, seal_number INT NOT NULL, quantity INT NOT NULL, tour_number VARCHAR(255) NOT NULL, arrival_time TIME(0) WITHOUT TIME ZONE NOT NULL, departure_time TIME(0) WITHOUT TIME ZONE NOT NULL, trailer_plate VARCHAR(255) NOT NULL, tractor_plate VARCHAR(255) NOT NULL, number_reference INT NOT NULL, nombre_palette INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2CB20DC979B1AD6 ON shipment (company_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2CB20DC8C063686 ON shipment (consigne_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2CB20DC3A5080C8 ON shipment (delivery_location_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2CB20DC7A65737D ON shipment (loading_location_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2CB20DC97C86FA4 ON shipment (transporteur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2CB20DCE338982D ON shipment (type_loading_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN shipment.arrival_time IS '(DC2Type:time_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN shipment.departure_time IS '(DC2Type:time_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE transporteur (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type_loading (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON users (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC8C063686 FOREIGN KEY (consigne_id) REFERENCES consigne (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC3A5080C8 FOREIGN KEY (delivery_location_id) REFERENCES delivery_location (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC7A65737D FOREIGN KEY (loading_location_id) REFERENCES loading_locations (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC97C86FA4 FOREIGN KEY (transporteur_id) REFERENCES transporteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DCE338982D FOREIGN KEY (type_loading_id) REFERENCES type_loading (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment DROP CONSTRAINT FK_2CB20DC979B1AD6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment DROP CONSTRAINT FK_2CB20DC8C063686
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment DROP CONSTRAINT FK_2CB20DC3A5080C8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment DROP CONSTRAINT FK_2CB20DC7A65737D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment DROP CONSTRAINT FK_2CB20DC97C86FA4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE shipment DROP CONSTRAINT FK_2CB20DCE338982D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE company
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE consigne
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE delivery_location
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE loading_locations
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE shipment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE transporteur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type_loading
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
