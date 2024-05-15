<?php

namespace frontend\modules\v1\validation;

use yii\base\Model;

class Search extends Model
{
    public string $search;

    public function rules(): array
    {
        return [
            [['search'], 'required'],
            [['search'], 'string', 'min' => 3],
        ];
    }
}
