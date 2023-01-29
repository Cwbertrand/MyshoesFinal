<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127083745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adult_size (id INT AUTO_INCREMENT NOT NULL, adultsize DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adult_size_product (adult_size_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_5D508D9546430C8B (adult_size_id), INDEX IDX_5D508D954584665A (product_id), PRIMARY KEY(adult_size_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adult_size_product ADD CONSTRAINT FK_5D508D9546430C8B FOREIGN KEY (adult_size_id) REFERENCES adult_size (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adult_size_product ADD CONSTRAINT FK_5D508D954584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adult_size_product DROP FOREIGN KEY FK_5D508D9546430C8B');
        $this->addSql('ALTER TABLE adult_size_product DROP FOREIGN KEY FK_5D508D954584665A');
        $this->addSql('DROP TABLE adult_size');
        $this->addSql('DROP TABLE adult_size_product');
    }
}
