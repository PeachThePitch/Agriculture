<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313095703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element_chimique (id INT AUTO_INCREMENT NOT NULL, libelle_element VARCHAR(50) NOT NULL, unite_id INT NOT NULL, INDEX IDX_DD3A4BFAEC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE element_chimique ADD CONSTRAINT FK_DD3A4BFAEC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element_chimique DROP FOREIGN KEY FK_DD3A4BFAEC4A74AB');
        $this->addSql('DROP TABLE element_chimique');
    }
}
