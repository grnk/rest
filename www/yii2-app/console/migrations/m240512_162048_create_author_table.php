<?php

use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m240512_162048_create_author_table extends Migration
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

        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull()->comment('Фамилия Имя Отчество'),
            'year_of_birth' => $this->date()->comment('Год рождения'),
            'biography' => $this->text()->comment('Биография'),
            'created_at' => $this->dateTime()->comment('Дата создания в БД'),
            'updated_at' => $this->timestamp()->comment('Дата обновления в БД'),
        ], $tableOptions);

        $this->addCommentOnTable('author', 'Таблица для хранения информации об авторах');

        $this->createIndex('idx_author_full_name', 'author', 'full_name');
        $this->createIndex('idx_author_year_of_birth', 'author', 'year_of_birth');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
    }
}
