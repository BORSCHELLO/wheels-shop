<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124094223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD postal_code INT NOT NULL, CHANGE note_of_order note_of_order VARCHAR(500) DEFAULT NULL, CHANGE status status ENUM("processing", "approved", "complited") DEFAULT "processing" NOT NULL, CHANGE first_name first_name VARCHAR(30) NOT NULL, CHANGE last_name last_name VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP postal_code, CHANGE first_name first_name INT NOT NULL, CHANGE last_name last_name INT NOT NULL, CHANGE note_of_order note_of_order VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status status VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
