<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116145950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combat (id INT AUTO_INCREMENT NOT NULL, pokemon1_id INT DEFAULT NULL, pokemon2_id INT DEFAULT NULL, nbr_tour INT NOT NULL, INDEX IDX_8D51E3981722D724 (pokemon1_id), INDEX IDX_8D51E39859778CA (pokemon2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, point_de_vie INT NOT NULL, point_attaque INT NOT NULL, point_defense INT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E3981722D724 FOREIGN KEY (pokemon1_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E39859778CA FOREIGN KEY (pokemon2_id) REFERENCES pokemon (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E3981722D724');
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E39859778CA');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
