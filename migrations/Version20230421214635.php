<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230421214635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_vo_id INT NOT NULL, reference VARCHAR(255) NOT NULL, total_ht DOUBLE PRECISION NOT NULL, command_date DATETIME NOT NULL, command_status VARCHAR(255) NOT NULL, INDEX IDX_8ECAEAD4A837E25D (user_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_product (id INT AUTO_INCREMENT NOT NULL, command_vo_id INT NOT NULL, product_vo_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_3C20574ED95D4C36 (command_vo_id), INDEX IDX_3C20574EEBA96259 (product_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A837E25D FOREIGN KEY (user_vo_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574ED95D4C36 FOREIGN KEY (command_vo_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574EEBA96259 FOREIGN KEY (product_vo_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD reference VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A837E25D');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574ED95D4C36');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574EEBA96259');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_product');
        $this->addSql('ALTER TABLE `order` DROP reference');
    }
}
