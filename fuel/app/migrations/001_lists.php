<?php 
namespace Fuel\Migrations;

class Lists
{

    function up()
    {
        \DBUtil::create_table('lists', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'title' => array('type' => 'varchar', 'constraint' => 100),
            
            
        ), array('id'));

        \DB::query("INSERT INTO lists (id,title) VALUES ('1','apps2m');")->execute();
    }

    function down()
    {
       \DBUtil::drop_table('lists');
    }
}