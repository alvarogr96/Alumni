<?php

namespace Fuel\Migrations;
class Assign
{
    function up()
    {
        \DBUtil::create_table('assign', array(
            'id_list' => array('type' => 'int', 'constraint' => 11,),
            'id_board' => array('type' => 'int', 'constraint' => 11),
        ), array('id_list','id_board'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromAssignToLists',
		            'key' => 'id_list',
		            'reference' => array(
		                'table' => 'lists',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
                array(
                    'constraint' => 'foreignKeyFromAssignToBoard',
                    'key' => 'id_board',
                    'reference' => array(
                        'table' => 'board',
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
       \DBUtil::drop_table('assign');
    }
}