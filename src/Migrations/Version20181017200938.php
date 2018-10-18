<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181017200938 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE question ADD teacher_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E41807E1D FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E41807E1D ON question (teacher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, subject_id INT NOT NULL, question VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_D87F7E0C23EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E41807E1D');
        $this->addSql('DROP INDEX IDX_B6F7494E41807E1D ON question');
        $this->addSql('ALTER TABLE question DROP teacher_id');
    }
}
