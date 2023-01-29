<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127081547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE other_categories (id INT AUTO_INCREMENT NOT NULL, adultsize DOUBLE PRECISION NOT NULL, childrensize DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE other_categories_product (other_categories_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_FC5F941941588B1 (other_categories_id), INDEX IDX_FC5F9414584665A (product_id), PRIMARY KEY(other_categories_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE other_categories_product ADD CONSTRAINT FK_FC5F941941588B1 FOREIGN KEY (other_categories_id) REFERENCES other_categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE other_categories_product ADD CONSTRAINT FK_FC5F9414584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE other_categories_product DROP FOREIGN KEY FK_FC5F941941588B1');
        $this->addSql('ALTER TABLE other_categories_product DROP FOREIGN KEY FK_FC5F9414584665A');
        $this->addSql('DROP TABLE other_categories');
        $this->addSql('DROP TABLE other_categories_product');
    }
}
