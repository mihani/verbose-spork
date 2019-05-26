<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190526203952 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE form ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD deleted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP deleted_at');
        $this->addSql('ALTER TABLE form DROP deleted_at');
        $this->addSql('ALTER TABLE question DROP deleted_at');
    }
}
