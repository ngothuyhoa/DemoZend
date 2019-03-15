<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315022709 extends AbstractMigration
{
    public function getDescription() : string
    {
        $description = 'This is the initial migration which creates blog tables.';
        return $description;
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        //Create "Categories" table
        $table = $schema->createTable('categories');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);        
        $table->addColumn('title', 'string', ['notnull'=>true]);
        $table->addColumn('slug', 'string', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');

        //create 'Books' table
        $table = $schema->createTable('books');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);        
        $table->addColumn('category_id', 'integer', ['notnull'=>true]);
        $table->addColumn('name', 'string', ['notnull'=>true]);
        $table->addColumn('slug', 'string', ['notnull'=>true]);
        $table->addColumn('price', 'integer', ['notnull'=>true]);
        $table->addColumn('content', 'text', ['notnull'=>true]);
        $table->addColumn('description', 'text', ['notnull'=>true]);
        $table->addColumn('add_information', 'text', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');
        $table->addIndex(['category_id'], 'category_id_index');
        $table->addForeignKeyConstraint('categories', ['category_id'], ['id'], [], 'books_category_id_fk');

        //create 'images' table
        $table = $schema->createTable('images');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]);        
        $table->addColumn('url', 'string', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');

        // Create 'book_image' table
        $table = $schema->createTable('book_image');
        $table->addColumn('id', 'integer', ['autoincrement'=>true]); 
        $table->addColumn('book_id', 'integer', ['notnull'=>true]);
        $table->addColumn('image_id', 'integer', ['notnull'=>true]);
        $table->setPrimaryKey(['id']);
        $table->addOption('engine' , 'InnoDB');
        $table->addIndex(['book_id'], 'book_id_index');
        $table->addIndex(['image_id'], 'image_id_index');
        $table->addForeignKeyConstraint('books', ['book_id'], ['id'], [], 'book_image_book_id_fk');
        $table->addForeignKeyConstraint('images', ['image_id'], ['id'], [], 'book_image_image_id_fk');  

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $schema->dropTable('book_image');
        $table->removeForeignKey('book_image_book_id_fk');
        $table->removeForeignKey('book_image_image_id_fk');
        $table->dropIndex('post_id_index');
        $table->dropIndex('tag_id_index'); 

        $schema->dropTable('categories');

        $schema->dropTable('books');
        $table->dropIndex('category_id_index'); 
        $table->removeForeignKey('books_category_id_fk');

        $schema->dropTable('images');
        
    }
}
