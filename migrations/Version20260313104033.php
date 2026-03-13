<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313104033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, qte_recolte INT NOT NULL, parcelle_id INT NOT NULL, production_id INT NOT NULL, INDEX IDX_B6A99CEB4433ED66 (parcelle_id), INDEX IDX_B6A99CEBECC6147F (production_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE engrais (id INT AUTO_INCREMENT NOT NULL, nom_engrais VARCHAR(255) NOT NULL, unite_id INT NOT NULL, INDEX IDX_A81E4023EC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE posseder (id INT AUTO_INCREMENT NOT NULL, valeur INT NOT NULL, code_element_id INT NOT NULL, id_engrais_id INT NOT NULL, INDEX IDX_62EF7CBA37B1D7C2 (code_element_id), INDEX IDX_62EF7CBAF3B6CF90 (id_engrais_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, nom_production VARCHAR(255) NOT NULL, unite_id INT NOT NULL, INDEX IDX_D3EDB1E0EC4A74AB (unite_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEB4433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEBECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE engrais ADD CONSTRAINT FK_A81E4023EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE posseder ADD CONSTRAINT FK_62EF7CBA37B1D7C2 FOREIGN KEY (code_element_id) REFERENCES element_chimique (id)');
        $this->addSql('ALTER TABLE posseder ADD CONSTRAINT FK_62EF7CBAF3B6CF90 FOREIGN KEY (id_engrais_id) REFERENCES engrais (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEB4433ED66');
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEBECC6147F');
        $this->addSql('ALTER TABLE engrais DROP FOREIGN KEY FK_A81E4023EC4A74AB');
        $this->addSql('ALTER TABLE posseder DROP FOREIGN KEY FK_62EF7CBA37B1D7C2');
        $this->addSql('ALTER TABLE posseder DROP FOREIGN KEY FK_62EF7CBAF3B6CF90');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0EC4A74AB');
        $this->addSql('DROP TABLE culture');
        $this->addSql('DROP TABLE engrais');
        $this->addSql('DROP TABLE posseder');
        $this->addSql('DROP TABLE production');
    }
}
