<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $amount_of
 * @property string|null $description
 *
 * @property Bucket[] $buckets
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'amount_of', 'description'], 'default', 'value' => null],
            [['category_id'], 'required'],
            [['category_id', 'price', 'amount_of'], 'integer'],
            [['name'], 'string', 'max' => 350],
            [['description'], 'string', 'max' => 1000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'price' => 'Price',
            'amount_of' => 'Amount Of',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Buckets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuckets()
    {
        return $this->hasMany(Bucket::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

}
