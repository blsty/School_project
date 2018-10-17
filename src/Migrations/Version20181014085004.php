<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181014085004 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exam (id INT AUTO_INCREMENT NOT NULL, subject_id INT NOT NULL, name VARCHAR(255) NOT NULL, for_all TINYINT(1) NOT NULL, INDEX IDX_38BBA6C623EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exam_user (exam_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7750FA578D5E91 (exam_id), INDEX IDX_7750FAA76ED395 (user_id), PRIMARY KEY(exam_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam ADD CONSTRAINT FK_38BBA6C623EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE exam_user ADD CONSTRAINT FK_7750FA578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_user ADD CONSTRAINT FK_7750FAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exam_user DROP FOREIGN KEY FK_7750FA578D5E91');
        $this->addSql('DROP TABLE exam');
        $this->addSql('DROP TABLE exam_user');
    }
}
