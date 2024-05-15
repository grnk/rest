<?php

namespace console\domain;

use common\models\Article;
use common\models\ArticleCategory;
use common\models\Author;
use common\models\Category;
use DateTime;

class Filling
{
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $author = new Author([
                'full_name' => "name{$i} surname{$i}",
                'year_of_birth' => (new DateTime('now'))->format('Y-m-d'),
                'biography' => "author{$i} biography{$i}",
            ]);
            $author->save();
        }
        for ($i = 0; $i < 100; $i++) {
            $article = new Article([
                'name' => "article_name{$i}",
                'picture' => "images/article_image{$i}",
                'announcement' => "announcement_{$i}",
                'text' => "text{$i}",
                'author_id' => rand(1, 100),
            ]);

            $article->save();
        }

        for ($i = 0; $i < 50; $i++) {
            $category = new Category([
                'name' => "Category_name{$i}",
                'description' => "Category_description{$i}",
                'parent_id' => null,
            ]);
            $category->save();
        }
        for ($i = 50; $i < 200; $i++) {
            $category = new Category([
                'name' => "Category_name{$i}",
                'description' => "Category_description{$i}",
                'parent_id' => rand(1, 50),
            ]);
            $category->save();
        }
        for ($i = 0; $i < 100; $i++) {
            $articleCategory = new ArticleCategory([
                'article_id' => rand(1, 100),
                'category_id' => rand(1, 200),
            ]);
            $articleCategory->save();
        }
    }
}
