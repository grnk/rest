<?php

namespace frontend\modules\v1;

use Yii;
use yii\web\Response;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'frontend\modules\v1\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::$app->request->parsers = ['application/json' => 'yii\web\JsonParser'];
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->formatters[Response::FORMAT_JSON] = [
            'class' => 'yii\web\JsonResponseFormatter',
        ];
    }
}
