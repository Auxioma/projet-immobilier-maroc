<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260106084109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agencies ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE agencies ADD CONSTRAINT FK_F65A4DC467B3B43D FOREIGN KEY (users_id) REFERENCES "user" (id) NOT DEFERRABLE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F65A4DC467B3B43D ON agencies (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agencies DROP CONSTRAINT FK_F65A4DC467B3B43D');
        $this->addSql('DROP INDEX UNIQ_F65A4DC467B3B43D');
        $this->addSql('ALTER TABLE agencies DROP users_id');
    }
}
