<?php

namespace app\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notice".
 *
 * @property int $id
 * @property string|null $title
 * @property float|null $price
 * @property int|null $category_id
 * @property int|null $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $photo
 * @property int|null $status
 * @property string $desc
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'price', 'category_id', 'city_id', 'user_id' ,'created_at', 'updated_at', 'status'], 'integer'],
            ['title', 'string', 'max' => 255],
            ['title', 'required', 'message' => 'Заполните Заголовок объявления'],
            ['desc', 'string'],
            ['desc', 'required', 'message' => 'Заполните Описание объявления'],
            ['price', 'integer', 'message' => 'Цена должна быть целым числом'],
            ['price', 'required', 'message' => 'Укажите цену'],
            ['photo', 'file', 'maxSize' => 10485760, 'message' => 'Максимальный размер фотографии 10 Мб!'],
            ['photo', 'file', 'extensions' => 'png, jpg, jpeg', 'wrongExtension' => 'Неверный формат файла. Выберите фотографию формата jpg, jpeg, png.'],
            ['user_id', 'default', 'value' => Yii::$app->user->id ],
            ['photo', 'default', 'value' => 'prod.png' ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Цена',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'photo' => 'Фотография',
            'status' => 'Status',
            'category_id' => 'Категория',
            'city_id' => 'Город',
            'desc' => 'Описание'
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ]
        ];
    }

    public function getCategory(){
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCity(){
        return $this->hasOne( City::class, [ 'id' => 'city_id' ] );
    }

    public function getOwner(){
        return $this->hasOne( User::class, [ 'id' => 'user_id' ] );
    }


    public function getStatus()    {
        return ($this->status == 1) ? 'Активное' : 'Закрытое';
    }

    public function getImage(){
        return Image::getImage( ($this->photo) ?: 'prod.png' );
    }

    public function deactivate(){
        $this->status = 0;
        $this->save();
    }

}
