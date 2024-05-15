<?php

namespace frontend\modules\v1\models;

use common\models\Article;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;

class ApiArticle extends Article
{
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(ApiAuthor::class, ['id' => 'author_id']);
    }

    /**
     * @throws InvalidConfigException
     */
    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(ApiCategory::class, ['id' => 'category_id'])
            ->viaTable('article_category', ['article_id' => 'id']);
    }

    public function fields(): array
    {
        return [
            'id',
            'name',
            'picture',
            'announcement',
            'text',
            'author' => fn() => $this->author,
            'categories' => fn() => $this->categories,
        ];
    }
}
