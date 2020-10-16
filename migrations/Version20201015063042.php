<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201015063042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tire DROP INDEX UNIQ_A2CE96DB12469DE2, ADD INDEX IDX_A2CE96DB12469DE2 (category_id)');
        $this->addSql('ALTER TABLE tire ADD brand_id INT NOT NULL, DROP brand');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DB44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_A2CE96DB44F5D008 ON tire (brand_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB44F5D008');
        $this->addSql('DROP TABLE brand');
        $this->addSql('ALTER TABLE tire DROP INDEX IDX_A2CE96DB12469DE2, ADD UNIQUE INDEX UNIQ_A2CE96DB12469DE2 (category_id)');
        $this->addSql('DROP INDEX IDX_A2CE96DB44F5D008 ON tire');
        $this->addSql('ALTER TABLE tire ADD brand VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP brand_id');
    }
}
