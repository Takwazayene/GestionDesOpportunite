<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831221357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opportunite (id INT AUTO_INCREMENT NOT NULL, commercial VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, territoire VARCHAR(255) DEFAULT NULL, client VARCHAR(255) DEFAULT NULL, accord VARCHAR(255) DEFAULT NULL, etape_transaction VARCHAR(255) DEFAULT NULL, confiance DOUBLE PRECISION DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, date_soumission DATE DEFAULT NULL, date_attribution DATE DEFAULT NULL, val_total DOUBLE PRECISION DEFAULT NULL, val_nette DOUBLE PRECISION DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE opportunite');
    }
}
