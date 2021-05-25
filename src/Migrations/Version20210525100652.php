<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525100652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE formated_answer (id INT NOT NULL, uuid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, company_description VARCHAR(255) NOT NULL, contact_reason VARCHAR(255) NOT NULL, cooptation TINYINT(1) DEFAULT \'0\' NOT NULL, outdated TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer CHANGE group_by_token group_by_token VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE question ADD formated_answer_role VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formated_answer ADD received_at DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93247968D17F50A6 ON formated_answer (uuid)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE formated_answer');
        $this->addSql('ALTER TABLE answer CHANGE group_by_token group_by_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE question DROP formated_answer_role');
        $this->addSql('DROP INDEX UNIQ_93247968D17F50A6 ON formated_answer');
        $this->addSql('ALTER TABLE formated_answer DROP received_at, CHANGE id id INT NOT NULL');
    }
}
