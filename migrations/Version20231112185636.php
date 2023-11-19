<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112185636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_game_night (user_id INT NOT NULL, game_night_id INT NOT NULL, INDEX IDX_848EB0F4A76ED395 (user_id), INDEX IDX_848EB0F4D4C7B377 (game_night_id), PRIMARY KEY(user_id, game_night_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_game_night ADD CONSTRAINT FK_848EB0F4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game_night ADD CONSTRAINT FK_848EB0F4D4C7B377 FOREIGN KEY (game_night_id) REFERENCES game_night (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_game_night DROP FOREIGN KEY FK_848EB0F4A76ED395');
        $this->addSql('ALTER TABLE user_game_night DROP FOREIGN KEY FK_848EB0F4D4C7B377');
        $this->addSql('DROP TABLE user_game_night');
    }
}
