<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118125048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_item (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tire_id INT NOT NULL, quantity INT UNSIGNED NOT NULL, INDEX IDX_F0FE2527A76ED395 (user_id), INDEX IDX_F0FE2527BC5ADD68 (tire_id), UNIQUE INDEX user_item (user_id, tire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, tire_id INT NOT NULL, source VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C53D045FBC5ADD68 (tire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tire_id INT NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(30) NOT NULL, total_cost INT NOT NULL, payment_method VARCHAR(30) NOT NULL, delivery_method VARCHAR(30) NOT NULL, note_of_order VARCHAR(500) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_F5299398A76ED395 (user_id), UNIQUE INDEX UNIQ_F5299398BC5ADD68 (tire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(100) NOT NULL, season VARCHAR(255) DEFAULT \'medium\' NOT NULL, width INT NOT NULL, height INT NOT NULL, diameter INT NOT NULL, sealing_method VARCHAR(255) DEFAULT \'tubeless\' NOT NULL, speed_index INT NOT NULL, load_index INT NOT NULL, studs VARCHAR(255) DEFAULT \'without\' NOT NULL, market_launch_date INT NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, rating DOUBLE PRECISION NOT NULL, discount INT NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_A2CE96DB44F5D008 (brand_id), INDEX IDX_A2CE96DB12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, address VARCHAR(100) NOT NULL, postal_code INT NOT NULL, phone VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE2527A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_item ADD CONSTRAINT FK_F0FE2527BC5ADD68 FOREIGN KEY (tire_id) REFERENCES tire (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBC5ADD68 FOREIGN KEY (tire_id) REFERENCES tire (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398BC5ADD68 FOREIGN KEY (tire_id) REFERENCES tire (id)');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DB44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DB12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB44F5D008');
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB12469DE2');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE2527BC5ADD68');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBC5ADD68');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398BC5ADD68');
        $this->addSql('ALTER TABLE cart_item DROP FOREIGN KEY FK_F0FE2527A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE cart_item');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE tire');
        $this->addSql('DROP TABLE user');
    }
}
