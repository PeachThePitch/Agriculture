<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313102709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, qte_recolte INT NOT NULL, parcelle_id INT NOT NULL, production_id INT NOT NULL, INDEX IDX_B6A99CEB4433ED66 (parcelle_id), INDEX IDX_B6A99CEBECC6147F (production_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEB4433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEBECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEB4433ED66');
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEBECC6147F');
        $this->addSql('DROP TABLE culture');
    }
}
