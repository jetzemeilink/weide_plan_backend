<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220723194731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, guest_id INT DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D4E6F819A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, guest_id INT NOT NULL, spot_id INT NOT NULL, camping_equipment_id INT NOT NULL, invoice_id INT DEFAULT NULL, arrival_date DATETIME NOT NULL, departure_date DATETIME NOT NULL, comment VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E00CEDDE9A4AA658 (guest_id), INDEX IDX_E00CEDDE2DF1D37C (spot_id), INDEX IDX_E00CEDDEE5F5C305 (camping_equipment_id), UNIQUE INDEX UNIQ_E00CEDDE2989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camping_equipment (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, has_electricity TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number_of_pax INT NOT NULL, has_dog TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, payment_method_id INT NOT NULL, booking_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_906517445AA1164F (payment_method_id), UNIQUE INDEX UNIQ_906517443301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, additional_cost_pct DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, distance_electricity VARCHAR(255) NOT NULL, is_season_spot TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F819A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE2DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEE5F5C305 FOREIGN KEY (camping_equipment_id) REFERENCES camping_equipment (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517445AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517443301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517443301C60');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEE5F5C305');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F819A4AA658');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9A4AA658');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE2989F1FD');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517445AA1164F');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE2DF1D37C');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE camping_equipment');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE spot');
    }
}
