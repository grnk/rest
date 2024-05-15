<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m240512_162144_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название'),
            'description' => $this->text()->comment('Описание'),
            'parent_id' => $this->integer()->comment('ID Родительской категории'),
            'created_at' => $this->dateTime()->comment('Дата создания в БД'),
            'updated_at' => $this->dateTime()->comment('Дата обновления в БД'),
        ], $tableOptions);

        $this->addCommentOnTable('category', 'Таблица для хранения категорий');

        $this->createIndex('idx_category_name', 'category', 'name');

        $this->addForeignKey(
            'fk_category_parent_id',
            'category',
            'parent_id',
            'category',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_category_parent_id', 'category');
        $this->dropTable('category');
    }
}
