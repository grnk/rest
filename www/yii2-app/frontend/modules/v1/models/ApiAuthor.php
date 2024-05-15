<?php

namespace frontend\modules\v1\models;

use common\models\Author;

class ApiAuthor extends Author
{
    public function fields(): array
    {
        return [
            'id',
            'full_name',
            'year_of_birth',
            'biography',
        ];
    }
}
