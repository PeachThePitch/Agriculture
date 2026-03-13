<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313104955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE epandre (id INT AUTO_INCREMENT NOT NULL, engrais_id INT NOT NULL, parcelle_id INT NOT NULL, date_id INT NOT NULL, INDEX IDX_5F64826F563C4F47 (engrais_id), INDEX IDX_5F64826F4433ED66 (parcelle_id), INDEX IDX_5F64826FB897366B (date_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE epandre ADD CONSTRAINT FK_5F64826F563C4F47 FOREIGN KEY (engrais_id) REFERENCES engrais (id)');
        $this->addSql('ALTER TABLE epandre ADD CONSTRAINT FK_5F64826F4433ED66 FOREIGN KEY (parcelle_id) REFERENCES parcelle (id)');
        $this->addSql('ALTER TABLE epandre ADD CONSTRAINT FK_5F64826FB897366B FOREIGN KEY (date_id) REFERENCES date (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE epandre DROP FOREIGN KEY FK_5F64826F563C4F47');
        $this->addSql('ALTER TABLE epandre DROP FOREIGN KEY FK_5F64826F4433ED66');
        $this->addSql('ALTER TABLE epandre DROP FOREIGN KEY FK_5F64826FB897366B');
        $this->addSql('DROP TABLE epandre');
    }
}
