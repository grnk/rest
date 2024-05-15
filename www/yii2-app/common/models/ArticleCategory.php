<?php

namespace common\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $article_id
 * @property int $category_id
 * @property string|null $created_at
 *
 * @property-read  Article $article
 * @property-read  Category $category
 */
class ArticleCategory extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => (new DateTime('now'))->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'article_category';
    }

    public function rules(): array
    {
        return [
            [['article_id', 'category_id'], 'required'],
            [['article_id', 'category_id'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'article_id' => 'ID Статьи',
            'category_id' => 'ID Категории',
            'created_at' => 'Дата создания в БД',
        ];
    }

    public function getArticle(): ActiveQuery
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
