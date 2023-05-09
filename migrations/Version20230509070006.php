<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509070006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD advantage_vo_id INT DEFAULT NULL, ADD has_discount_code TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D4368D01 FOREIGN KEY (advantage_vo_id) REFERENCES advantage (id)');
        $this->addSql('CREATE INDEX IDX_F5299398D4368D01 ON `order` (advantage_vo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398D4368D01');
        $this->addSql('DROP INDEX IDX_F5299398D4368D01 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP advantage_vo_id, DROP has_discount_code');
    }
}
