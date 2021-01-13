<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113144641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, registration VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, registration_year DATE DEFAULT NULL, buy_value INT NOT NULL, lifetime INT NOT NULL, work_time INT NOT NULL, horsepower INT DEFAULT NULL, use_cost DOUBLE PRECISION DEFAULT NULL, residual_value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE equipment');
    }
}
