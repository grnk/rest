<?php

namespace frontend\modules\v1\controllers;

use frontend\modules\v1\models\ApiCategory;
use yii\rest\ActiveController;

class CategoryController extends ActiveController
{
    public $modelClass = ApiCategory::class;

    public function actions(): array
    {
        $actions = parent::actions();

        unset(
            $actions['index'],
            $actions['create'],
            $actions['update'],
            $actions['delete'],
            $actions['options'],
        );

        return $actions;
    }
}
