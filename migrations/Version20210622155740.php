<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622155740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page CHANGE choice_1_text choice_1_text VARCHAR(255) DEFAULT NULL, CHANGE choice_2_text choice_2_text VARCHAR(255) DEFAULT NULL, CHANGE choice_3_text choice_3_text VARCHAR(255) DEFAULT NULL, CHANGE choice_4_text choice_4_text VARCHAR(255) DEFAULT NULL, CHANGE choice_1_target choice_1_target INT DEFAULT NULL, CHANGE choice_2_target choice_2_target INT DEFAULT NULL, CHANGE choice_3_target choice_3_target INT DEFAULT NULL, CHANGE choice_4_target choice_4_target INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page CHANGE choice_1_text choice_1_text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE choice_2_text choice_2_text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE choice_3_text choice_3_text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE choice_4_text choice_4_text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE choice_1_target choice_1_target INT NOT NULL, CHANGE choice_2_target choice_2_target INT NOT NULL, CHANGE choice_3_target choice_3_target INT NOT NULL, CHANGE choice_4_target choice_4_target INT NOT NULL');
    }
}
