<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509075321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939835B1D642');
        $this->addSql('DROP INDEX IDX_F529939835B1D642 ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE contain_vo_id advantage_vo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D4368D01 FOREIGN KEY (advantage_vo_id) REFERENCES advantage (id)');
        $this->addSql('CREATE INDEX IDX_F5299398D4368D01 ON `order` (advantage_vo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398D4368D01');
        $this->addSql('DROP INDEX IDX_F5299398D4368D01 ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE advantage_vo_id contain_vo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939835B1D642 FOREIGN KEY (contain_vo_id) REFERENCES contain (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F529939835B1D642 ON `order` (contain_vo_id)');
    }
}
