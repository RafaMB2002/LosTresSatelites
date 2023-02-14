<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214075044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje ADD banda_id_id INT NOT NULL, ADD modo_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01F4659115 FOREIGN KEY (banda_id_id) REFERENCES banda (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D0129A8E8E6 FOREIGN KEY (modo_id_id) REFERENCES modo (id)');
        $this->addSql('CREATE INDEX IDX_9B631D01F4659115 ON mensaje (banda_id_id)');
        $this->addSql('CREATE INDEX IDX_9B631D0129A8E8E6 ON mensaje (modo_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01F4659115');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D0129A8E8E6');
        $this->addSql('DROP INDEX IDX_9B631D01F4659115 ON mensaje');
        $this->addSql('DROP INDEX IDX_9B631D0129A8E8E6 ON mensaje');
        $this->addSql('ALTER TABLE mensaje DROP banda_id_id, DROP modo_id_id');
    }
}
