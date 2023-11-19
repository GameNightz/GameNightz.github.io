<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108142805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_night_user (game_night_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D6E8191FD4C7B377 (game_night_id), INDEX IDX_D6E8191FA76ED395 (user_id), PRIMARY KEY(game_night_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_night_user ADD CONSTRAINT FK_D6E8191FD4C7B377 FOREIGN KEY (game_night_id) REFERENCES game_night (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_night_user ADD CONSTRAINT FK_D6E8191FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_night ADD date_and_time DATETIME NOT NULL, ADD description LONGTEXT NOT NULL, DROP datum, DROP uhrzeit, DROP beschreibung, CHANGE spiele games LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE plaetze slots INT NOT NULL, CHANGE alterfreigabe ageage_rating INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_night_user DROP FOREIGN KEY FK_D6E8191FD4C7B377');
        $this->addSql('ALTER TABLE game_night_user DROP FOREIGN KEY FK_D6E8191FA76ED395');
        $this->addSql('DROP TABLE game_night_user');
        $this->addSql('ALTER TABLE game_night ADD datum DATE NOT NULL, ADD uhrzeit TIME NOT NULL, ADD beschreibung VARCHAR(400) NOT NULL, DROP date_and_time, DROP description, CHANGE games spiele LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE slots plaetze INT NOT NULL, CHANGE ageage_rating alterfreigabe INT DEFAULT NULL');
    }
}
