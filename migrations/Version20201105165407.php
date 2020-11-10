<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105165407 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tire_id INT NOT NULL, count INT NOT NULL, UNIQUE INDEX UNIQ_BA388B7A76ED395 (user_id), UNIQUE INDEX UNIQ_BA388B7BC5ADD68 (tire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7BC5ADD68 FOREIGN KEY (tire_id) REFERENCES tire (id)');
        $this->addSql('DROP INDEX IDX_A2CE96DB4EC001D1 ON tire');
        $this->addSql('DROP INDEX IDX_A2CE96DB6640A8C3 ON tire');
        $this->addSql('ALTER TABLE tire CHANGE season season VARCHAR(255) DEFAULT \'medium\' NOT NULL, CHANGE sealing_method sealing_method VARCHAR(255) DEFAULT \'tubeless\' NOT NULL, CHANGE studs studs VARCHAR(255) DEFAULT \'without\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cart');
        $this->addSql('ALTER TABLE tire CHANGE season season VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE sealing_method sealing_method VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE studs studs VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX IDX_A2CE96DB4EC001D1 ON tire (season)');
        $this->addSql('CREATE INDEX IDX_A2CE96DB6640A8C3 ON tire (sealing_method)');
    }
}
