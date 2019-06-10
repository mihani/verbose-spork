<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610173823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question_choice (id VARCHAR(255) NOT NULL, question_id VARCHAR(255) DEFAULT NULL, label VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, typeform_id VARCHAR(255) NOT NULL, typeform_ref VARCHAR(255) NOT NULL, INDEX IDX_C6F6759A1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_choice ADD CONSTRAINT FK_C6F6759A1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer CHANGE answer content VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE form ADD typeform_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD multiple_choice TINYINT(1) NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD typeform_id VARCHAR(255) NOT NULL, ADD typeform_ref VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE question_choice');
        $this->addSql('ALTER TABLE answer CHANGE content answer VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE form DROP typeform_id');
        $this->addSql('ALTER TABLE question DROP multiple_choice, DROP type, DROP typeform_id, DROP typeform_ref');
    }
}
