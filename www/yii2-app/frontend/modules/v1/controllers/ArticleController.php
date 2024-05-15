<?php

namespace frontend\modules\v1\controllers;

use frontend\modules\v1\models\ApiArticle;
use frontend\modules\v1\validation\Search;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class ArticleController extends ActiveController
{
    public $modelClass = ApiArticle::class;

    protected function verbs(): array
    {
        return array_merge(
            parent::verbs(),
            [
                'search' => ['GET']
            ]
        );
    }

    public function actions(): array
    {
        $actions = parent::actions();

        unset(
            $actions['create'],
            $actions['update'],
            $actions['delete'],
            $actions['options'],
        );

        return $actions;
    }

    public function actionSearch(): array
    {
        $validationModel = new Search([
            'search' => Yii::$app->request->get('search', '')
        ]);

        if (!$validationModel->validate()) {
            throw new BadRequestHttpException(current($validationModel->firstErrors));
        }

        return ApiArticle::find()
            ->joinWith([
                'categories',
                'author',
            ])
            ->andWhere(
                ['or',
                    ['like', 'article.name', $validationModel->search],
                    ['like', 'category.name', $validationModel->search],
                    ['like', 'author.full_name', $validationModel->search],
                ]
            )->all();
    }
}
