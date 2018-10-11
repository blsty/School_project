<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010212247 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A71179CD6');
        $this->addSql('DROP INDEX IDX_FBCE3E7A71179CD6 ON subject');
        $this->addSql('ALTER TABLE subject ADD name VARCHAR(255) NOT NULL, CHANGE name_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FBCE3E7AA76ED395 ON subject (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7AA76ED395');
        $this->addSql('DROP INDEX IDX_FBCE3E7AA76ED395 ON subject');
        $this->addSql('ALTER TABLE subject DROP name, CHANGE user_id name_id INT NOT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A71179CD6 FOREIGN KEY (name_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FBCE3E7A71179CD6 ON subject (name_id)');
    }
}
