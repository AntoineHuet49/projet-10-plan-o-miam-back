<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214094354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(36) NOT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups_user (groups_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F0F44878F373DCF (groups_id), INDEX IDX_F0F44878A76ED395 (user_id), PRIMARY KEY(groups_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, quantities DOUBLE PRECISION DEFAULT NULL, unit VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lunchs (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, time VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lunchs_recipes (lunchs_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_6100804EA4CF9C7A (lunchs_id), INDEX IDX_6100804EFDF2B1FA (recipes_id), PRIMARY KEY(lunchs_id, recipes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lunchs_groups (lunchs_id INT NOT NULL, groups_id INT NOT NULL, INDEX IDX_4EF065CCA4CF9C7A (lunchs_id), INDEX IDX_4EF065CCF373DCF (groups_id), PRIMARY KEY(lunchs_id, groups_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, rating INT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_ingredients (recipes_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_761206B0FDF2B1FA (recipes_id), INDEX IDX_761206B03EC4DCE (ingredients_id), PRIMARY KEY(recipes_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, recipe_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_6970EB0FA76ED395 (user_id), INDEX IDX_6970EB0F59D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE steps (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_34220A7259D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(100) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groups_user ADD CONSTRAINT FK_F0F44878F373DCF FOREIGN KEY (groups_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groups_user ADD CONSTRAINT FK_F0F44878A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lunchs_recipes ADD CONSTRAINT FK_6100804EA4CF9C7A FOREIGN KEY (lunchs_id) REFERENCES lunchs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lunchs_recipes ADD CONSTRAINT FK_6100804EFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lunchs_groups ADD CONSTRAINT FK_4EF065CCA4CF9C7A FOREIGN KEY (lunchs_id) REFERENCES lunchs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lunchs_groups ADD CONSTRAINT FK_4EF065CCF373DCF FOREIGN KEY (groups_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B0FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B03EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE steps ADD CONSTRAINT FK_34220A7259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groups_user DROP FOREIGN KEY FK_F0F44878F373DCF');
        $this->addSql('ALTER TABLE groups_user DROP FOREIGN KEY FK_F0F44878A76ED395');
        $this->addSql('ALTER TABLE lunchs_recipes DROP FOREIGN KEY FK_6100804EA4CF9C7A');
        $this->addSql('ALTER TABLE lunchs_recipes DROP FOREIGN KEY FK_6100804EFDF2B1FA');
        $this->addSql('ALTER TABLE lunchs_groups DROP FOREIGN KEY FK_4EF065CCA4CF9C7A');
        $this->addSql('ALTER TABLE lunchs_groups DROP FOREIGN KEY FK_4EF065CCF373DCF');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B0FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B03EC4DCE');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FA76ED395');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0F59D8A214');
        $this->addSql('ALTER TABLE steps DROP FOREIGN KEY FK_34220A7259D8A214');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE groups_user');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE lunchs');
        $this->addSql('DROP TABLE lunchs_recipes');
        $this->addSql('DROP TABLE lunchs_groups');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE recipes_ingredients');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE steps');
        $this->addSql('DROP TABLE user');
    }
}
