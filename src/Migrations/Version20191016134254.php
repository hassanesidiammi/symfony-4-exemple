<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016134254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, desription VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_AC6A4CA264D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_shop (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, shop_id INT NOT NULL, INDEX IDX_426C559DA76ED395 (user_id), INDEX IDX_426C559D4D16C4DD (shop_id), UNIQUE INDEX favorite_shop_idx (user_id, shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_shop_disliked (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, shop_id INT NOT NULL, INDEX IDX_9B166C10A76ED395 (user_id), INDEX IDX_9B166C104D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop ADD CONSTRAINT FK_AC6A4CA264D218E FOREIGN KEY (location_id) REFERENCES app_location (id)');
        $this->addSql('ALTER TABLE favorite_shop ADD CONSTRAINT FK_426C559DA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE favorite_shop ADD CONSTRAINT FK_426C559D4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE user_shop_disliked ADD CONSTRAINT FK_9B166C10A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE user_shop_disliked ADD CONSTRAINT FK_9B166C104D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorite_shop DROP FOREIGN KEY FK_426C559D4D16C4DD');
        $this->addSql('ALTER TABLE user_shop_disliked DROP FOREIGN KEY FK_9B166C104D16C4DD');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE favorite_shop');
        $this->addSql('DROP TABLE user_shop_disliked');
    }
}
