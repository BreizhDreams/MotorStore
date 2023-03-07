<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307174019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advantage (id INT AUTO_INCREMENT NOT NULL, advantage_type_vo_id INT NOT NULL, reference VARCHAR(255) NOT NULL, expiration_date DATETIME NOT NULL, advantage_name VARCHAR(255) NOT NULL, INDEX IDX_298E21A1FF70C14C (advantage_type_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advantage_fidelity_card (advantage_id INT NOT NULL, fidelity_card_id INT NOT NULL, INDEX IDX_6937E86C3864498A (advantage_id), INDEX IDX_6937E86CCA4FE9A9 (fidelity_card_id), PRIMARY KEY(advantage_id, fidelity_card_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advantage_type (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_advantage (category_id INT NOT NULL, advantage_id INT NOT NULL, INDEX IDX_EEEEF39112469DE2 (category_id), INDEX IDX_EEEEF3913864498A (advantage_id), PRIMARY KEY(category_id, advantage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_vo_id INT NOT NULL, reference VARCHAR(255) NOT NULL, total_ht DOUBLE PRECISION NOT NULL, command_date DATETIME NOT NULL, command_status VARCHAR(255) NOT NULL, INDEX IDX_8ECAEAD4A837E25D (user_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_product (id INT AUTO_INCREMENT NOT NULL, command_vo_id INT NOT NULL, product_vo_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_3C20574ED95D4C36 (command_vo_id), INDEX IDX_3C20574EEBA96259 (product_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fidelity_card (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, total_points INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_vo_id INT NOT NULL, brand_vo_id INT NOT NULL, designation VARCHAR(255) NOT NULL, prix_ttc DOUBLE PRECISION NOT NULL, photo_url VARCHAR(255) NOT NULL, INDEX IDX_D34A04ADA2C6564C (category_vo_id), INDEX IDX_D34A04AD110CD012 (brand_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_advantage (product_id INT NOT NULL, advantage_id INT NOT NULL, INDEX IDX_472E972C4584665A (product_id), INDEX IDX_472E972C3864498A (advantage_id), PRIMARY KEY(product_id, advantage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fidelity_card_vo_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, tel_number VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649EC8630E3 (fidelity_card_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advantage ADD CONSTRAINT FK_298E21A1FF70C14C FOREIGN KEY (advantage_type_vo_id) REFERENCES advantage_type (id)');
        $this->addSql('ALTER TABLE advantage_fidelity_card ADD CONSTRAINT FK_6937E86C3864498A FOREIGN KEY (advantage_id) REFERENCES advantage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advantage_fidelity_card ADD CONSTRAINT FK_6937E86CCA4FE9A9 FOREIGN KEY (fidelity_card_id) REFERENCES fidelity_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_advantage ADD CONSTRAINT FK_EEEEF39112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_advantage ADD CONSTRAINT FK_EEEEF3913864498A FOREIGN KEY (advantage_id) REFERENCES advantage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A837E25D FOREIGN KEY (user_vo_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574ED95D4C36 FOREIGN KEY (command_vo_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE command_product ADD CONSTRAINT FK_3C20574EEBA96259 FOREIGN KEY (product_vo_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA2C6564C FOREIGN KEY (category_vo_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD110CD012 FOREIGN KEY (brand_vo_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE product_advantage ADD CONSTRAINT FK_472E972C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_advantage ADD CONSTRAINT FK_472E972C3864498A FOREIGN KEY (advantage_id) REFERENCES advantage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EC8630E3 FOREIGN KEY (fidelity_card_vo_id) REFERENCES fidelity_card (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advantage DROP FOREIGN KEY FK_298E21A1FF70C14C');
        $this->addSql('ALTER TABLE advantage_fidelity_card DROP FOREIGN KEY FK_6937E86C3864498A');
        $this->addSql('ALTER TABLE advantage_fidelity_card DROP FOREIGN KEY FK_6937E86CCA4FE9A9');
        $this->addSql('ALTER TABLE category_advantage DROP FOREIGN KEY FK_EEEEF39112469DE2');
        $this->addSql('ALTER TABLE category_advantage DROP FOREIGN KEY FK_EEEEF3913864498A');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A837E25D');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574ED95D4C36');
        $this->addSql('ALTER TABLE command_product DROP FOREIGN KEY FK_3C20574EEBA96259');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA2C6564C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD110CD012');
        $this->addSql('ALTER TABLE product_advantage DROP FOREIGN KEY FK_472E972C4584665A');
        $this->addSql('ALTER TABLE product_advantage DROP FOREIGN KEY FK_472E972C3864498A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EC8630E3');
        $this->addSql('DROP TABLE advantage');
        $this->addSql('DROP TABLE advantage_fidelity_card');
        $this->addSql('DROP TABLE advantage_type');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_advantage');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_product');
        $this->addSql('DROP TABLE fidelity_card');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_advantage');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
