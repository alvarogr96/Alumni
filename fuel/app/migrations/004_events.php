<?php 
namespace Fuel\Migrations;
class Events
{
    function up()
    {
        \DBUtil::create_table('events', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'type' => array('type' => 'varchar', 'constraint' => 100),
            'tittle' => array('type' => 'varchar', 'constraint' => 100),
            'description' => array('type' => 'int', 'constraint' => 100),
            'id_user' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromEventsToUser',
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
       \DBUtil::drop_table('events');
    }
}