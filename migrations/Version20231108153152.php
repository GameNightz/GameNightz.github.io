<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108153152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_night_user DROP FOREIGN KEY FK_D6E8191FA76ED395');
        $this->addSql('ALTER TABLE game_night_user DROP FOREIGN KEY FK_D6E8191FD4C7B377');
        $this->addSql('DROP TABLE game_night_user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD preferred_games LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', DROP is_verified, DROP vorname, DROP nachname, DROP lieblingsspiele, CHANGE email email VARCHAR(255) NOT NULL, CHANGE roles roles VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_night_user (game_night_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D6E8191FD4C7B377 (game_night_id), INDEX IDX_D6E8191FA76ED395 (user_id), PRIMARY KEY(game_night_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE game_night_user ADD CONSTRAINT FK_D6E8191FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_night_user ADD CONSTRAINT FK_D6E8191FD4C7B377 FOREIGN KEY (game_night_id) REFERENCES game_night (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, ADD vorname VARCHAR(255) NOT NULL, ADD nachname VARCHAR(255) NOT NULL, ADD lieblingsspiele LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', DROP first_name, DROP last_name, DROP preferred_games, CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
