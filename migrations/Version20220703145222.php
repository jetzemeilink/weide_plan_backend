<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703145222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(/** @lang sql */'CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, guest_id INT NOT NULL, spot_id INT DEFAULT NULL, camping_equipment_id INT NOT NULL, invoice_id INT DEFAULT NULL, arrival_date DATETIME NOT NULL, departure_date DATETIME NOT NULL, comment VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E00CEDDE9A4AA658 (guest_id), UNIQUE INDEX UNIQ_E00CEDDE2DF1D37C (spot_id), INDEX IDX_E00CEDDEE5F5C305 (camping_equipment_id), UNIQUE INDEX UNIQ_E00CEDDE2989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(/** @lang sql */'CREATE TABLE camping_equipment (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, has_electricity TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(/** @lang sql */'CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number_of_pax INT NOT NULL, city VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, has_dog TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(/** @lang sql */'CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, guest_id INT DEFAULT NULL, payment_method_id INT NOT NULL, amount_bruto INT NOT NULL, amount_netto INT NOT NULL, UNIQUE INDEX UNIQ_906517449A4AA658 (guest_id), INDEX IDX_906517445AA1164F (payment_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(/** @lang sql */'CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, additional_cost_pct DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(/** @lang sql */'CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(255) DEFAULT NULL, distance_electricity VARCHAR(255) DEFAULT NULL, is_season_spot TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(/** @lang sql */'ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql(/** @lang sql */'ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE2DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql(/** @lang sql */'ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEE5F5C305 FOREIGN KEY (camping_equipment_id) REFERENCES camping_equipment (id)');
        $this->addSql(/** @lang sql */'ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql(/** @lang sql */'ALTER TABLE invoice ADD CONSTRAINT FK_906517449A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql(/** @lang sql */'ALTER TABLE invoice ADD CONSTRAINT FK_906517445AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(/** @lang sql */'ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEE5F5C305');
        $this->addSql(/** @lang sql */'ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9A4AA658');
        $this->addSql(/** @lang sql */'ALTER TABLE invoice DROP FOREIGN KEY FK_906517449A4AA658');
        $this->addSql(/** @lang sql */'ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE2989F1FD');
        $this->addSql(/** @lang sql */'ALTER TABLE invoice DROP FOREIGN KEY FK_906517445AA1164F');
        $this->addSql(/** @lang sql */'ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE2DF1D37C');
        $this->addSql(/** @lang sql */'DROP TABLE booking');
        $this->addSql(/** @lang sql */'DROP TABLE camping_equipment');
        $this->addSql(/** @lang sql */'DROP TABLE guest');
        $this->addSql(/** @lang sql */'DROP TABLE invoice');
        $this->addSql(/** @lang sql */'DROP TABLE payment_method');
        $this->addSql(/** @lang sql */'DROP TABLE spot');
    }
}
