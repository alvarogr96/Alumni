<?php 
namespace Fuel\Migrations;
class Users
{
    function up()
    {
        \DBUtil::create_table('users', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'username' => array('type' => 'varchar', 'constraint' => 100),
            'email' => array('type' => 'varchar', 'constraint' => 100),
            'password' => array('type' => 'varchar', 'constraint' => 100),
            'image_profile' => array('type' => 'varchar', 'constraint' => 100),
            'id_rol' => array('type' => 'int', 'constraint' => 11),
            'id_list' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromUsersToRoles',
		            'key' => 'id_rol',
		            'reference' => array(
		                'table' => 'roles',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
		        array(
		            'constraint' => 'foreignKeyFromUsersToLists',
		            'key' => 'id_list',
		            'reference' => array(
		                'table' => 'lists',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        )
		    )
		);
		\DB::query("INSERT INTO users (id, username, email, password, image_profile, id_rol, id_list) VALUES (NULL, 'admin', 'admin@cev.com', 'admin', 'NULL', '1', '1');")->execute();
    }
    function down()
    {
       \DBUtil::drop_table('users');
    }
}