<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123133246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_game_night (game_id INT NOT NULL, game_night_id INT NOT NULL, INDEX IDX_CD35B1F5E48FD905 (game_id), INDEX IDX_CD35B1F5D4C7B377 (game_night_id), PRIMARY KEY(game_id, game_night_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_user (game_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6686BA65E48FD905 (game_id), INDEX IDX_6686BA65A76ED395 (user_id), PRIMARY KEY(game_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_night (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slots INT NOT NULL, age_rating INT NOT NULL, date_and_time DATETIME NOT NULL, describtion LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, gender VARCHAR(1) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', is_verified TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_game_night (user_id INT NOT NULL, game_night_id INT NOT NULL, INDEX IDX_848EB0F4A76ED395 (user_id), INDEX IDX_848EB0F4D4C7B377 (game_night_id), PRIMARY KEY(user_id, game_night_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_game_night ADD CONSTRAINT FK_CD35B1F5E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_game_night ADD CONSTRAINT FK_CD35B1F5D4C7B377 FOREIGN KEY (game_night_id) REFERENCES game_night (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game_night ADD CONSTRAINT FK_848EB0F4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game_night ADD CONSTRAINT FK_848EB0F4D4C7B377 FOREIGN KEY (game_night_id) REFERENCES game_night (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_game_night DROP FOREIGN KEY FK_CD35B1F5E48FD905');
        $this->addSql('ALTER TABLE game_game_night DROP FOREIGN KEY FK_CD35B1F5D4C7B377');
        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA65E48FD905');
        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA65A76ED395');
        $this->addSql('ALTER TABLE user_game_night DROP FOREIGN KEY FK_848EB0F4A76ED395');
        $this->addSql('ALTER TABLE user_game_night DROP FOREIGN KEY FK_848EB0F4D4C7B377');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_game_night');
        $this->addSql('DROP TABLE game_user');
        $this->addSql('DROP TABLE game_night');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_game_night');
    }
}
