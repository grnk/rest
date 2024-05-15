<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m240512_162115_create_article_table extends Migration
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

        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название статьи'),
            'picture' => $this->string()->comment('Относительный путь к картинке'),
            'announcement' => $this->text()->comment('Анонс'),
            'text' => $this->text()->comment('Текст статьи'),
            'author_id' => $this->integer()->comment('ID Автора статьи'),
            'created_at' => $this->dateTime()->comment('Дата создания в БД'),
            'updated_at' => $this->dateTime()->comment('Дата обновления в БД'),
        ], $tableOptions);

        $this->addCommentOnTable('article', 'Таблица для хранения статей');

        $this->createIndex('idx_article_name', 'article', 'name');

        $this->addForeignKey(
            'fk_article_author_id',
            'article',
            'author_id',
            'author',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_article_author_id', 'article');
        $this->dropTable('article');
    }
}
