<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623182745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD choice_1_target_id INT DEFAULT NULL, ADD choice_2_target_id INT DEFAULT NULL, ADD choice_3_target_id INT DEFAULT NULL, ADD choice_4_target_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB62083B72ACD FOREIGN KEY (choice_1_target_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6201A554CCC FOREIGN KEY (choice_2_target_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620DBDB930C FOREIGN KEY (choice_3_target_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620F2E0868F FOREIGN KEY (choice_4_target_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_140AB62083B72ACD ON page (choice_1_target_id)');
        $this->addSql('CREATE INDEX IDX_140AB6201A554CCC ON page (choice_2_target_id)');
        $this->addSql('CREATE INDEX IDX_140AB620DBDB930C ON page (choice_3_target_id)');
        $this->addSql('CREATE INDEX IDX_140AB620F2E0868F ON page (choice_4_target_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB62083B72ACD');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6201A554CCC');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620DBDB930C');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620F2E0868F');
        $this->addSql('DROP INDEX IDX_140AB62083B72ACD ON page');
        $this->addSql('DROP INDEX IDX_140AB6201A554CCC ON page');
        $this->addSql('DROP INDEX IDX_140AB620DBDB930C ON page');
        $this->addSql('DROP INDEX IDX_140AB620F2E0868F ON page');
        $this->addSql('ALTER TABLE page DROP choice_1_target_id, DROP choice_2_target_id, DROP choice_3_target_id, DROP choice_4_target_id');
    }
}
