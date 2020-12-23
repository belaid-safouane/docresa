<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805101830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, filename VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE picture picture VARCHAR(255) DEFAULT NULL, CHANGE hash hash VARCHAR(255) DEFAULT NULL, CHANGE filename filename VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ad CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL, CHANGE filename filename VARCHAR(255) DEFAULT NULL, CHANGE facebook facebook VARCHAR(255) DEFAULT NULL, CHANGE instagram instagram VARCHAR(255) DEFAULT NULL, CHANGE twitter twitter VARCHAR(255) DEFAULT NULL, CHANGE whatsapp whatsapp VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE expertise CHANGE ad_id ad_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE ad CHANGE cover_image cover_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE facebook facebook VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE instagram instagram VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE twitter twitter VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE whatsapp whatsapp VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE expertise CHANGE ad_id ad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE hash hash VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
