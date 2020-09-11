<?php


namespace app\models;


use phpDocumentor\Reflection\Types\Boolean;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UserForm extends Model
{
    public $nm;
    public $city_id;
    public $phone;
    public $photo;
    public $about;

    public function rules(){
        return [
            [ [ 'nm', 'city_id', 'phone' ], 'required'],
            ['nm', 'required', 'message' => 'Заполните Имя'],
            ['city_id', 'required', 'message' => 'Укажите свой город'],
            ['phone', 'required', 'message' => 'Укажите свой мобильный телефон'],
            ['phone', 'number', 'min' => 10, 'message' => 'Укажите свой мобильный телефон'],
            ['about', 'safe'],
            ['photo', 'file',  'extensions' => 'png, jpg, jpeg', 'wrongExtension' => 'Неверный формат файла. Выберите аватарку формата jpg, jpeg, png.'],
            ['photo', 'file', 'maxSize' => 3145728],


        ];
    }

    public function attributeLabels(){
        return [
            'nm' => 'Имя',
            'city_id' => 'Город',
            'phone' => 'Телефон'
        ];
    }


    public function getAvatar(){
        return Image::getImage( $this->photo );
    }


}