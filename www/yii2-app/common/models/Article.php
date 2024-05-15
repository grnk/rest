<?php

namespace common\models;

use DateTime;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string|null $picture
 * @property string|null $announcement
 * @property string|null $text
 * @property int|null $author_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property-read ArticleCategory[] $articleCategories
 * @property-read Category[] $categories
 * @property-read Author $author
 */
class Article extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => (new DateTime('now'))->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'article';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['announcement', 'text'], 'string'],
            [['author_id'], 'integer'],
            [['name', 'picture'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название статьи',
            'picture' => 'Относительный путь к картинке',
            'announcement' => 'Анонс',
            'text' => 'Текст статьи',
            'author_id' => 'ID Автора статьи',
            'created_at' => 'Дата создания в БД',
            'updated_at' => 'Дата обновления в БД',
        ];
    }

    public function getArticleCategories(): ActiveQuery
    {
        return $this->hasMany(ArticleCategory::class, ['article_id' => 'id']);
    }

    /**
     * @throws InvalidConfigException
     */
    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('article_category', ['article_id' => 'id']);
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}
