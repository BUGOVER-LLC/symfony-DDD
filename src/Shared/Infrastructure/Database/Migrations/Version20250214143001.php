<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250214143001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX uniq_c74f2195c74f2195');
        $this->addSql('ALTER TABLE refresh_token ALTER valid TYPE DATE');
        $this->addSql('ALTER TABLE refresh_token ALTER valid DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN refresh_token.valid IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE users ALTER password DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE refresh_token ALTER valid TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE refresh_token ALTER valid SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN refresh_token.valid IS NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_c74f2195c74f2195 ON refresh_token (refresh_token)');
        $this->addSql('ALTER TABLE users ALTER password SET NOT NULL');
    }
}
