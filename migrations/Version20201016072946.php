<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201016072946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire ADD season_id INT NOT NULL, ADD design_id INT NOT NULL, ADD sealing_method_id INT NOT NULL, ADD thorns_id INT NOT NULL, DROP season, DROP design, DROP sealing_method, DROP thorns');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DB4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DBE41DC9B2 FOREIGN KEY (design_id) REFERENCES design (id)');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DB6640A8C3 FOREIGN KEY (sealing_method_id) REFERENCES sealing (id)');
        $this->addSql('ALTER TABLE tire ADD CONSTRAINT FK_A2CE96DBB5D477C3 FOREIGN KEY (thorns_id) REFERENCES thorns (id)');
        $this->addSql('CREATE INDEX IDX_A2CE96DB4EC001D1 ON tire (season_id)');
        $this->addSql('CREATE INDEX IDX_A2CE96DBE41DC9B2 ON tire (design_id)');
        $this->addSql('CREATE INDEX IDX_A2CE96DB6640A8C3 ON tire (sealing_method_id)');
        $this->addSql('CREATE INDEX IDX_A2CE96DBB5D477C3 ON tire (thorns_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB4EC001D1');
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DBE41DC9B2');
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DB6640A8C3');
        $this->addSql('ALTER TABLE tire DROP FOREIGN KEY FK_A2CE96DBB5D477C3');
        $this->addSql('DROP INDEX IDX_A2CE96DB4EC001D1 ON tire');
        $this->addSql('DROP INDEX IDX_A2CE96DBE41DC9B2 ON tire');
        $this->addSql('DROP INDEX IDX_A2CE96DB6640A8C3 ON tire');
        $this->addSql('DROP INDEX IDX_A2CE96DBB5D477C3 ON tire');
        $this->addSql('ALTER TABLE tire ADD season VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD design VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD sealing_method VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD thorns VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP season_id, DROP design_id, DROP sealing_method_id, DROP thorns_id');
    }
}
