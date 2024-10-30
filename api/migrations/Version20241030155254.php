<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241030155254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER first_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER last_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER birth_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(255)');
        $this->addSql('COMMENT ON COLUMN "user".birth_date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER first_name TYPE TEXT');
        $this->addSql('ALTER TABLE "user" ALTER last_name TYPE TEXT');
        $this->addSql('ALTER TABLE "user" ALTER birth_date TYPE DATE');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE TEXT');
        $this->addSql('COMMENT ON COLUMN "user".birth_date IS NULL');
    }
}
