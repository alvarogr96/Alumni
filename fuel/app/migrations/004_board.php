<?php

namespace Fuel\Migrations;
class Board
{
    function up()
    {
        \DBUtil::create_table('board', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
<<<<<<< HEAD:fuel/app/migrations/004_board.php
            'type' => array('type' => 'varchar', 'constraint' => 100),
=======
            'type' => array('type' => 'int', 'constraint' => 100),
>>>>>>> d9023047155a03ecc3dbe1c06d36ee3d2c653df6:fuel/app/migrations/004_board.php
            'title' => array('type' => 'varchar', 'constraint' => 100),
            'description' => array('type' => 'varchar', 'constraint' => 100),
            'localization' => array('type' => 'varchar', 'constraint' => 100),
            'destination' => array('type' => 'varchar', 'constraint' => 100),
            'link' => array('type' => 'varchar', 'constraint' => 100),
            'id_user' => array('type' => 'int', 'constraint' => 11, 'null' => true),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromBoardToUser',
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
       \DBUtil::drop_table('board');
    }
}