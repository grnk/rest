<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */

class m240512_173104_create_article_category_table extends Migration
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

        $this->createTable('article_category', [
            'article_id' => $this->integer()->notNull()->comment('ID Статьи'),
            'category_id' => $this->integer()->notNull()->comment('ID Категории'),
            'created_at' => $this->dateTime()->comment('Дата создания в БД'),
        ], $tableOptions);

        $this->addCommentOnTable('article_category', 'Таблица для связи между статьями и категориями');

        $this->addForeignKey(
            'FK_article_category_article_id',
            'article_category',
            'article_id',
            'article',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk_article_category_category_id',
            'article_category',
            'category_id',
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
        $this->dropForeignKey('fk_article_category_category_id', 'article_category');
        $this->dropForeignKey('fk_article_category_article_id', 'article_category');
        $this->dropTable('article_category');
    }
}
