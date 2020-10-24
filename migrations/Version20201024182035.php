<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024182035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB6640A8C3');
        $this->addSql('ALTER TABLE tire CHANGE COLUMN sealing_method_id sealing_method ENUM("tube", "tubeless")');
    }

    public function down(Schema $schema) : void
    {
        throw new \RuntimeException('Net');
    }
}
