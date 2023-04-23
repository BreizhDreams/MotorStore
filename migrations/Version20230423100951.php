<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230423100951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A837E25D');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574ED95D4C36');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574EEBA96259');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_product');
        $this->addSql('ALTER TABLE `order` ADD stripe_session_id VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_vo_id INT NOT NULL, reference VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, total_ht DOUBLE PRECISION NOT NULL, command_date DATETIME NOT NULL, command_status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8ECAEAD4A837E25D (user_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE command_product (id INT AUTO_INCREMENT NOT NULL, command_vo_id INT NOT NULL, product_vo_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_3C20574ED95D4C36 (command_vo_id), INDEX IDX_3C20574EEBA96259 (product_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A837E25D FOREIGN KEY (user_vo_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574ED95D4C36 FOREIGN KEY (command_vo_id) REFERENCES command (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574EEBA96259 FOREIGN KEY (product_vo_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `order` DROP stripe_session_id');
    }
}
