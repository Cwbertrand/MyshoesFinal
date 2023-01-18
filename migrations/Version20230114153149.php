<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230114153149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_detail (id INT AUTO_INCREMENT NOT NULL, command_id INT NOT NULL, quantity INT NOT NULL, productname VARCHAR(255) NOT NULL, productprice INT NOT NULL, productimage VARCHAR(255) NOT NULL, commandtotal DOUBLE PRECISION NOT NULL, productmark VARCHAR(255) NOT NULL, productdescription LONGTEXT NOT NULL, INDEX IDX_9145B6D033E1689A (command_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_detail ADD CONSTRAINT FK_9145B6D033E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_detail DROP FOREIGN KEY FK_9145B6D033E1689A');
        $this->addSql('DROP TABLE command_detail');
    }
}
