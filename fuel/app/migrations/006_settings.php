<?php 
namespace Fuel\Migrations;

class Settings
{

    function up()
    {
        \DBUtil::create_table('settings', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'sound' => array('type' => 'varchar', 'constraint' => 100),
            'notifications' => array('type' => 'varchar', 'constraint' => 100),
            'id_user' => array('type' => 'int', 'constraint' => 5),

            
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
            array(
                array(
                    'constraint' => 'foreignKeyFromSettingsToUsers',
                    'key' => 'id_user',
                    'reference' => array(
                        'table' => 'users',
                        'column' => 'id',
                    ),
                    'on_update' => 'CASCADE',
                    'on_delete' => 'RESTRICT'
                )
            )
        );
    }

    function down()
    {
      
       \DBUtil::drop_table('settings');
    }
}