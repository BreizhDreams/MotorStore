<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230507202508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contain (id INT AUTO_INCREMENT NOT NULL, fidelity_card_vo_id INT NOT NULL, advantage_vo_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_4BEFF7C8EC8630E3 (fidelity_card_vo_id), INDEX IDX_4BEFF7C8D4368D01 (advantage_vo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C8EC8630E3 FOREIGN KEY (fidelity_card_vo_id) REFERENCES fidelity_card (id)');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C8D4368D01 FOREIGN KEY (advantage_vo_id) REFERENCES advantage (id)');
        $this->addSql('ALTER TABLE advantage_fidelity_card DROP FOREIGN KEY FK_6937E86C3864498A');
        $this->addSql('ALTER TABLE advantage_fidelity_card DROP FOREIGN KEY FK_6937E86CCA4FE9A9');
        $this->addSql('DROP TABLE advantage_fidelity_card');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advantage_fidelity_card (advantage_id INT NOT NULL, fidelity_card_id INT NOT NULL, INDEX IDX_6937E86C3864498A (advantage_id), INDEX IDX_6937E86CCA4FE9A9 (fidelity_card_id), PRIMARY KEY(advantage_id, fidelity_card_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE advantage_fidelity_card ADD CONSTRAINT FK_6937E86C3864498A FOREIGN KEY (advantage_id) REFERENCES advantage (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE advantage_fidelity_card ADD CONSTRAINT FK_6937E86CCA4FE9A9 FOREIGN KEY (fidelity_card_id) REFERENCES fidelity_card (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contain DROP FOREIGN KEY FK_4BEFF7C8EC8630E3');
        $this->addSql('ALTER TABLE contain DROP FOREIGN KEY FK_4BEFF7C8D4368D01');
        $this->addSql('DROP TABLE contain');
    }
}
