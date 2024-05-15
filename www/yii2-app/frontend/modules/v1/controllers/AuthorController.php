<?php

namespace frontend\modules\v1\controllers;

use frontend\modules\v1\models\ApiAuthor;
use yii\rest\ActiveController;

class AuthorController extends ActiveController
{
    public $modelClass = ApiAuthor::class;

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
