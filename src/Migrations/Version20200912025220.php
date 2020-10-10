<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200912025220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    // todo: add migration sql to transfer goals to `todo`
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_todo (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, deleted TINYINT(1) NOT NULL, completed TINYINT(1) NOT NULL, display_on_dashboard TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_todo_element (id INT AUTO_INCREMENT NOT NULL, my_todo_id INT NOT NULL, name VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, completed TINYINT(1) NOT NULL, INDEX IDX_ECBCC86E60E7101F (my_todo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE my_todo_element ADD CONSTRAINT FK_ECBCC86E60E7101F FOREIGN KEY (my_todo_id) REFERENCES my_todo (id)');
        $this->addSql('ALTER TABLE my_todo ADD related_entity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_todo ADD CONSTRAINT FK_9A299FF4AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');

        $this->addSql('ALTER TABLE my_issue ADD todo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE my_issue ADD CONSTRAINT FK_7E6B91FAEA1EBC33 FOREIGN KEY (todo_id) REFERENCES my_todo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E6B91FAEA1EBC33 ON my_issue (todo_id)');

        $this->addSql('
            INSERT INTO module (`name`, `active`)
            VALUES("My Goals", true),
                  ("My Issues", true)   
        ');
    }

    public function down(Schema $schema) : void
    {
    }
}
