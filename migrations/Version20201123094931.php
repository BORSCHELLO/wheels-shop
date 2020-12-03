<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123094931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order_item` (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, tire_id INT NOT NULL, quantity INT NOT NULL, cost NUMERIC(10, 2) NOT NULL, INDEX IDX_52EA1F098D9F6D38 (order_id), INDEX IDX_52EA1F09BC5ADD68 (tire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order_item` ADD CONSTRAINT FK_52EA1F098D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order_item` ADD CONSTRAINT FK_52EA1F09BC5ADD68 FOREIGN KEY (tire_id) REFERENCES tire (id)');
        $this->addSql('ALTER TABLE `order` CHANGE total_cost total_cost NUMERIC(10, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order_item`');
        $this->addSql('ALTER TABLE `order` CHANGE total_cost total_cost INT NOT NULL');
    }
}