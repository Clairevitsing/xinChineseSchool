<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240511202154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339D86650F');
        $this->addSql('DROP INDEX IDX_B723AF339D86650F ON student');
        $this->addSql('ALTER TABLE student CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33A76ED395 ON student (user_id)');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D59D86650F');
        $this->addSql('DROP INDEX IDX_B0F6A6D59D86650F ON teacher');
        $this->addSql('ALTER TABLE teacher CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_B0F6A6D5A76ED395 ON teacher (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A76ED395');
        $this->addSql('DROP INDEX IDX_B723AF33A76ED395 ON student');
        $this->addSql('ALTER TABLE student CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B723AF339D86650F ON student (user_id_id)');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5A76ED395');
        $this->addSql('DROP INDEX IDX_B0F6A6D5A76ED395 ON teacher');
        $this->addSql('ALTER TABLE teacher CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B0F6A6D59D86650F ON teacher (user_id_id)');
    }
}
