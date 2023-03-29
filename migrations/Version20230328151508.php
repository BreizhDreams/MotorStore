<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328151508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE category ADD slug VARCHAR(255) NOT NULL, CHANGE designation designation VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sub_category ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brand DROP slug');
        $this->addSql('ALTER TABLE category DROP slug, CHANGE designation designation VARCHAR(750) NOT NULL, CHANGE description description VARCHAR(750) NOT NULL');
        $this->addSql('ALTER TABLE product DROP slug');
        $this->addSql('ALTER TABLE sub_category DROP slug');
    }
}
