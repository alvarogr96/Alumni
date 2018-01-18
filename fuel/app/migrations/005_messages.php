<?php 
namespace Fuel\Migrations;
class Messages
{
    function up()
    {
        \DBUtil::create_table('messages', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'message' => array('type' => 'varchar', 'constraint' => 100),
            'id_user_send' => array('type' => 'int', 'constraint' => 11),
            'id_user_receives' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromMessagesToUserSender',
		            'key' => 'id_user_send',
		            'reference' => array(
		                'table' => 'users',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
		        array(
		            'constraint' => 'foreignKeyFromMessagesToUserReceive',
		            'key' => 'id_user_receives',
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
       \DBUtil::drop_table('messages');
    }
}