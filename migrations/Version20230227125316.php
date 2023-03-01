<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227125316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, street VARCHAR(255) NOT NULL, postalcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adult_size (id INT AUTO_INCREMENT NOT NULL, adultsize DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, transportagency VARCHAR(255) NOT NULL, transportprice DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, create_at DATETIME NOT NULL, reference VARCHAR(255) NOT NULL, addressname VARCHAR(255) NOT NULL, addressmobile VARCHAR(255) DEFAULT NULL, addressstreet VARCHAR(255) NOT NULL, addresscompany VARCHAR(255) DEFAULT NULL, addresscp VARCHAR(255) NOT NULL, addresscity VARCHAR(255) NOT NULL, addresscountry VARCHAR(255) NOT NULL, stripesessionid VARCHAR(255) DEFAULT NULL, is_paid TINYINT(1) NOT NULL, deliverystatus INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, INDEX IDX_8ECAEAD4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_detail (id INT AUTO_INCREMENT NOT NULL, command_id INT NOT NULL, quantity INT NOT NULL, productname VARCHAR(255) NOT NULL, productprice INT NOT NULL, productimage VARCHAR(255) NOT NULL, commandtotal DOUBLE PRECISION NOT NULL, productmark VARCHAR(255) NOT NULL, productdescription LONGTEXT NOT NULL, size DOUBLE PRECISION NOT NULL, INDEX IDX_9145B6D033E1689A (command_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_us (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subject VARCHAR(255) NOT NULL, contacttext LONGTEXT NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_8205FDD0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE header (id INT AUTO_INCREMENT NOT NULL, headertitle VARCHAR(255) DEFAULT NULL, headertext LONGTEXT NOT NULL, headerimage VARCHAR(255) NOT NULL, headerurl VARCHAR(255) NOT NULL, headerbtn VARCHAR(255) NOT NULL, is_publish TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, mark VARCHAR(255) NOT NULL, shoesname VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, create_at DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, status TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, promotion INT DEFAULT NULL, is_best TINYINT(1) DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_shoes_gender (product_id INT NOT NULL, shoes_gender_id INT NOT NULL, INDEX IDX_F86DFFA74584665A (product_id), INDEX IDX_F86DFFA728DA6B27 (shoes_gender_id), PRIMARY KEY(product_id, shoes_gender_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_adult_size (product_id INT NOT NULL, adult_size_id INT NOT NULL, INDEX IDX_1B95DD654584665A (product_id), INDEX IDX_1B95DD6546430C8B (adult_size_id), PRIMARY KEY(product_id, adult_size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remarks (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, create_at DATETIME DEFAULT NULL, INDEX IDX_44EA8DDB4584665A (product_id), INDEX IDX_44EA8DDBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shoes_category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shoes_gender (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transporter (id INT AUTO_INCREMENT NOT NULL, transportagency VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wishlist (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_9CE12A31A76ED395 (user_id), INDEX IDX_9CE12A314584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_detail ADD CONSTRAINT FK_9145B6D033E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE contact_us ADD CONSTRAINT FK_8205FDD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES shoes_category (id)');
        $this->addSql('ALTER TABLE product_shoes_gender ADD CONSTRAINT FK_F86DFFA74584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_shoes_gender ADD CONSTRAINT FK_F86DFFA728DA6B27 FOREIGN KEY (shoes_gender_id) REFERENCES shoes_gender (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_adult_size ADD CONSTRAINT FK_1B95DD654584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_adult_size ADD CONSTRAINT FK_1B95DD6546430C8B FOREIGN KEY (adult_size_id) REFERENCES adult_size (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE remarks ADD CONSTRAINT FK_44EA8DDB4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE remarks ADD CONSTRAINT FK_44EA8DDBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wishlist ADD CONSTRAINT FK_9CE12A314584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A76ED395');
        $this->addSql('ALTER TABLE command_detail DROP FOREIGN KEY FK_9145B6D033E1689A');
        $this->addSql('ALTER TABLE contact_us DROP FOREIGN KEY FK_8205FDD0A76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product_shoes_gender DROP FOREIGN KEY FK_F86DFFA74584665A');
        $this->addSql('ALTER TABLE product_shoes_gender DROP FOREIGN KEY FK_F86DFFA728DA6B27');
        $this->addSql('ALTER TABLE product_adult_size DROP FOREIGN KEY FK_1B95DD654584665A');
        $this->addSql('ALTER TABLE product_adult_size DROP FOREIGN KEY FK_1B95DD6546430C8B');
        $this->addSql('ALTER TABLE remarks DROP FOREIGN KEY FK_44EA8DDB4584665A');
        $this->addSql('ALTER TABLE remarks DROP FOREIGN KEY FK_44EA8DDBA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A31A76ED395');
        $this->addSql('ALTER TABLE wishlist DROP FOREIGN KEY FK_9CE12A314584665A');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE adult_size');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_detail');
        $this->addSql('DROP TABLE contact_us');
        $this->addSql('DROP TABLE header');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_shoes_gender');
        $this->addSql('DROP TABLE product_adult_size');
        $this->addSql('DROP TABLE remarks');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE shoes_category');
        $this->addSql('DROP TABLE shoes_gender');
        $this->addSql('DROP TABLE transporter');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE wishlist');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
