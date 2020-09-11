<?php


namespace app\models;


use yii\base\Model;

class RegistrationForm extends Model
{
    public $email;
    public $pass;


    public function rules(){
        return [
            [ ['email', 'pass'], 'required' ],
            [ 'email', 'email', 'message' => 'Невалидный емэйл'],
            [ 'email', 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email', 'message' => 'Этот email же занят' ]
        ];
    }

    public function signup(){
        if( $this->validate() ){
            $user = new User;
            $user->attributes = $this->attributes;
            return $user->create();
        }

        return false;
    }

    public function attributeLabels(){
        return [
            'pass' => 'Пароль'
        ];
    }
}