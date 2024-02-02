<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201085456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet_competence (projet_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_15498055C18272 (projet_id), INDEX IDX_1549805515761DAB (competence_id), PRIMARY KEY(projet_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_competence ADD CONSTRAINT FK_15498055C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_competence ADD CONSTRAINT FK_1549805515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FC18272');
        $this->addSql('DROP INDEX IDX_94D4687FC18272 ON competence');
        $this->addSql('ALTER TABLE competence DROP projet_id, CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet_competence DROP FOREIGN KEY FK_15498055C18272');
        $this->addSql('ALTER TABLE projet_competence DROP FOREIGN KEY FK_1549805515761DAB');
        $this->addSql('DROP TABLE projet_competence');
        $this->addSql('ALTER TABLE competence ADD projet_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_94D4687FC18272 ON competence (projet_id)');
        $this->addSql('ALTER TABLE projet DROP description');
    }
}
