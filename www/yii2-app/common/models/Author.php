<?php

namespace common\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $full_name
 * @property string|null $year_of_birth
 * @property string|null $biography
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property-read  Article[] $articles
 */
class Author extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => (new DateTime('now'))->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'author';
    }

    public function rules(): array
    {
        return [
            [['full_name'], 'required'],
            [['year_of_birth'], 'safe'],
            [['biography'], 'string'],
            [['full_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'full_name' => 'Фамилия Имя Отчество',
            'year_of_birth' => 'Год рождения',
            'biography' => 'Биография',
            'created_at' => 'Дата создания в БД',
            'updated_at' => 'Дата обновления в БД',
        ];
    }

    public function getArticles(): ActiveQuery
    {
        return $this->hasMany(Article::class, ['author_id' => 'id']);
    }
}
