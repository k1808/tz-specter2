<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $phone_number
 * @property string|null $address
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['user_id'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'address'], 'string', 'max' => 128],
            [['phone_number'], 'string', 'max' => 15],
            ['phone_number', 'match', 'pattern' => '/^(8)[(](\d{3})[)](\d{3})[-](\d{2})[-](\d{2})/', 'message' => 'Телефона, должно быть в формате 8(XXX)XXX-XX-XX'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function create($user_id, $first_name, $middle_name, $last_name, $phone_number, $address)
    {
        $profile = new static();
        $profile->user_id = $user_id;
        $profile->first_name = $first_name;
        $profile->middle_name = $middle_name;
        $profile->last_name = $last_name;
        $profile->phone_number = $phone_number;
        $profile->address = $address;
        $profile -> save();
        return $profile;
    }
}
