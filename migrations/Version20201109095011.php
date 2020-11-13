<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109095011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_item DROP INDEX UNIQ_BA388B7A76ED395, ADD INDEX IDX_F0FE2527A76ED395 (user_id)');
        $this->addSql('ALTER TABLE cart_item DROP INDEX UNIQ_BA388B7BC5ADD68, ADD INDEX IDX_F0FE2527BC5ADD68 (tire_id)');
        $this->addSql('CREATE UNIQUE INDEX user_item ON cart_item (user_id, tire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_item DROP INDEX IDX_F0FE2527A76ED395, ADD UNIQUE INDEX UNIQ_BA388B7A76ED395 (user_id)');
        $this->addSql('ALTER TABLE cart_item DROP INDEX IDX_F0FE2527BC5ADD68, ADD UNIQUE INDEX UNIQ_BA388B7BC5ADD68 (tire_id)');
        $this->addSql('DROP INDEX user_item ON cart_item');
    }
}
