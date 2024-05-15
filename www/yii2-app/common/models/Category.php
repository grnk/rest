<?php

namespace common\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $parent_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property-read  ArticleCategory[] $articleCategories
 * @property-read  Category $parent
 */
class Category extends ActiveRecord
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
        return 'category';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'parent_id' => 'ID Родительской категории',
            'created_at' => 'Дата создания в БД',
            'updated_at' => 'Дата обновления в БД',
        ];
    }

    public function getArticleCategories(): ActiveQuery
    {
        return $this->hasMany(ArticleCategory::class, ['category_id' => 'id']);
    }

    public function getParent(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }
}
