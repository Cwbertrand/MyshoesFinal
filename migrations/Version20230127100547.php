<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127100547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_adult_size (product_id INT NOT NULL, adult_size_id INT NOT NULL, INDEX IDX_1B95DD654584665A (product_id), INDEX IDX_1B95DD6546430C8B (adult_size_id), PRIMARY KEY(product_id, adult_size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_adult_size ADD CONSTRAINT FK_1B95DD654584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_adult_size ADD CONSTRAINT FK_1B95DD6546430C8B FOREIGN KEY (adult_size_id) REFERENCES adult_size (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_adult_size DROP FOREIGN KEY FK_1B95DD654584665A');
        $this->addSql('ALTER TABLE product_adult_size DROP FOREIGN KEY FK_1B95DD6546430C8B');
        $this->addSql('DROP TABLE product_adult_size');
    }
}
