<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109081241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP INDEX IDX_BA388B7A76ED395, ADD UNIQUE INDEX UNIQ_BA388B7A76ED395 (user_id)');
        $this->addSql('ALTER TABLE cart DROP INDEX IDX_BA388B7BC5ADD68, ADD UNIQUE INDEX UNIQ_BA388B7BC5ADD68 (tire_id)');
        $this->addSql('ALTER TABLE cart CHANGE count quantity INT NOT NULL');
        $this->addSql('ALTER TABLE cart RENAME TO cart_item');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP INDEX UNIQ_BA388B7A76ED395, ADD INDEX IDX_BA388B7A76ED395 (user_id)');
        $this->addSql('ALTER TABLE cart DROP INDEX UNIQ_BA388B7BC5ADD68, ADD INDEX IDX_BA388B7BC5ADD68 (tire_id)');
        $this->addSql('ALTER TABLE cart CHANGE quantity count INT NOT NULL');
        $this->addSql('ALTER TABLE cart_item RENAME TO cart');
    }
}
