<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529153648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apikey (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, apikey VARCHAR(255) NOT NULL, created_time DATETIME NOT NULL, ttl INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE auth_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reqtime DATETIME NOT NULL, ipaddress VARCHAR(255) NOT NULL, is_valid BOOLEAN DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apikey');
        $this->addSql('DROP TABLE auth_request');
    }
}
