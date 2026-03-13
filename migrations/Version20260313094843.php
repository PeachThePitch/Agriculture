<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313094843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE engrais (id INT AUTO_INCREMENT NOT NULL, nom_engrais VARCHAR(255) NOT NULL, unite_id INT NOT NULL, INDEX IDX_A81E4023EC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, nom_production VARCHAR(255) NOT NULL, unite_id INT NOT NULL, INDEX IDX_D3EDB1E0EC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE engrais ADD CONSTRAINT FK_A81E4023EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE engrais DROP FOREIGN KEY FK_A81E4023EC4A74AB');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0EC4A74AB');
        $this->addSql('DROP TABLE engrais');
        $this->addSql('DROP TABLE production');
    }
}
