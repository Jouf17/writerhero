<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622155315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD choice_1_target INT NOT NULL, ADD choice_2_target INT NOT NULL, ADD choice_3_target INT NOT NULL, ADD choice_4_target INT NOT NULL, DROP choice_1_target_id, DROP choice_2_target_id, DROP choice_3_target_id, DROP choice_4_target_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD choice_1_target_id INT NOT NULL, ADD choice_2_target_id INT NOT NULL, ADD choice_3_target_id INT NOT NULL, ADD choice_4_target_id INT NOT NULL, DROP choice_1_target, DROP choice_2_target, DROP choice_3_target, DROP choice_4_target');
    }
}
