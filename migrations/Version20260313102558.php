<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313102558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posseder (id INT AUTO_INCREMENT NOT NULL, valeur INT NOT NULL, code_element_id INT NOT NULL, id_engrais_id INT NOT NULL, INDEX IDX_62EF7CBA37B1D7C2 (code_element_id), INDEX IDX_62EF7CBAF3B6CF90 (id_engrais_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE posseder ADD CONSTRAINT FK_62EF7CBA37B1D7C2 FOREIGN KEY (code_element_id) REFERENCES element_chimique (id)');
        $this->addSql('ALTER TABLE posseder ADD CONSTRAINT FK_62EF7CBAF3B6CF90 FOREIGN KEY (id_engrais_id) REFERENCES engrais (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posseder DROP FOREIGN KEY FK_62EF7CBA37B1D7C2');
        $this->addSql('ALTER TABLE posseder DROP FOREIGN KEY FK_62EF7CBAF3B6CF90');
        $this->addSql('DROP TABLE posseder');
    }
}
