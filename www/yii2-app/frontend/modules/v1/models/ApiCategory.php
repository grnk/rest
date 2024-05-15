<?php

namespace frontend\modules\v1\models;

use common\models\Category;
use yii\db\ActiveQuery;

class ApiCategory extends Category
{
    public function getParent(): ActiveQuery
    {
        return $this->hasOne(ApiCategory::class, ['id' => 'parent_id']);
    }

    public function fields(): array
    {
        return [
            'id',
            'name',
            'description',
            'parent_category' => fn() => $this->parent,
        ];
    }
}
