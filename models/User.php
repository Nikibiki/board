<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $nm
 * @property string|null $email
 * @property string|null $pass
 * @property string|null $photo
 * @property int|null $created_at
 * @property int|null $city_id
 * @property string|null $phone
 * @property string|null $about
 */
class User extends \yii\db\ActiveRecord  implements IdentityInterface
{



    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at' ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'city_id'], 'integer'],
            [['about'], 'string'],
            [['nm', 'email', 'pass', 'photo', 'phone'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm' => 'Имя: ',
            'email' => 'Email',
            'pass' => 'Pass',
            'photo' => 'Photo',
            'created_at' => 'На сайте с: ',
            'city_id' => 'Город: ',
            'phone' => 'Телефон: ',
            'about' => 'О себе: ',
        ];
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findByEmail( $email ){
        return User::find()->where( ['email' => $email] )->one();
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function validatePassword( $password ){
        if( $this->pass == $password )  {
            return true;
        }

        return false;
    }

    public function create(){
        return $this->save();
    }

    public function getAvatar(){
        return Image::getImage( $this->photo );
    }

    public function getTotalNotices(){
        return $this->hasMany( Notice::class, ['user_id' => 'id' ] )->count();
    }


}
