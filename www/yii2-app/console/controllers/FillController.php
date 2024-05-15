<?php

namespace console\controllers;

use console\domain\Filling;
use yii\console\Controller;
use yii\console\ExitCode;

class FillController extends Controller
{
    /**
     * Заполнение данных
     */
    public function actionIndex(): int
    {
        (new Filling())
            ->run();

        return ExitCode::OK;
    }
}
