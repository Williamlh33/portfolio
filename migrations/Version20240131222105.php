<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131222105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F597A6CB7');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE projets');
        $this->addSql('DROP INDEX IDX_94D4687F597A6CB7 ON competence');
        $this->addSql('ALTER TABLE competence CHANGE projets_id projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_94D4687FC18272 ON competence (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FC18272');
        $this->addSql('CREATE TABLE projets (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP INDEX IDX_94D4687FC18272 ON competence');
        $this->addSql('ALTER TABLE competence CHANGE projet_id projets_id INT NOT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_94D4687F597A6CB7 ON competence (projets_id)');
    }
}
