<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703145547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(/** @lang sql */ "INSERT INTO camping_equipment (`code`, `description`, `has_electricity`) VALUES ('CAR_E', 'Caravan met stroom', 1)");
        $this->addSql(/** @lang sql */ "INSERT INTO camping_equipment (`code`, `description`, `has_electricity`) VALUES ('CAM_E', 'Camper met stroom', 1)");
        $this->addSql(/** @lang sql */ "INSERT INTO camping_equipment (`code`, `description`, `has_electricity`) VALUES ('TENT_E', 'Tent met stroom', 1)");
        $this->addSql(/** @lang sql */ "INSERT INTO camping_equipment (`code`, `description`, `has_electricity`) VALUES ('CAR_NO_E', 'Caravan zonder stroom', 0)");
        $this->addSql(/** @lang sql */ "INSERT INTO camping_equipment (`code`, `description`, `has_electricity`) VALUES ('CAM_NO_E', 'Camper zonder stroom', 0)");
        $this->addSql(/** @lang sql */ "INSERT INTO camping_equipment (`code`, `description`, `has_electricity`) VALUES ('TENT_NO_E', 'Tent zonder stroom', 0)");

      // Temporarily fill all the spots with same data
        for ($i = 0; $i < 20; $i++) {
            $this->addSql(/** @lang sql */ "INSERT INTO spot (`size`, `distance_electricity`, `is_season_spot`) VALUES ('5 x 4', '20m', 0)");
    }

        $this->addSql(/** @lang sql */ "INSERT INTO payment_method (`code`, `description`, `additional_cost_pct`) VALUES ('CARD', 'Pinnen', 2.0)");
        $this->addSql(/** @lang sql */ "INSERT INTO payment_method (`code`, `description`, `additional_cost_pct`) VALUES ('CASH', 'Contant', 0)");
        $this->addSql(/** @lang sql */ "INSERT INTO payment_method (`code`, `description`, `additional_cost_pct`) VALUES ('TRANSFER', 'Overmaken via bank', 0)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
