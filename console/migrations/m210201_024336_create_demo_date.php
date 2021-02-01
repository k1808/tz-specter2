<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210201_024336_create_demo_date
 */
class m210201_024336_create_demo_date extends Migration
{

    public function up()
    {
        User::create('test1', 'test1@i.ua', '111');
        User::create('test2', 'test2@i.ua', '111');
        User::create('test3', 'test3@i.ua', '111');

        $this->batchInsert('profile', ['user_id','first_name', 'middle_name', 'last_name' , 'phone_number',
            'address'], [
                [1, 'Vasia', 'Vasilevich', 'Vasilev', '+380980989898', 'Kiev, Shevchenko,20'],
                [2, 'Ivanov', 'Ivan', 'Ivanovich', '+380985939898', 'Kiev, Shevchenko,25'],
                [3, 'Petr', 'Petrovich', 'Petrov', '+380980959898', 'Kiev, Shevchenko,26'],
        ]);

    }

    public function down()
    {
        $this->truncateTable('user');
        $this->truncateTable('profile');

    }
}
