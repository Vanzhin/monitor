<?php

declare(strict_types=1);

namespace App\Share\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620131111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE monitor_monitor (uuid VARCHAR(36) NOT NULL, contract VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, sip_server VARCHAR(255) NOT NULL, settings JSON DEFAULT \'[]\' NOT NULL, PRIMARY KEY(uuid))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE monitor_monitor');
    }
}
