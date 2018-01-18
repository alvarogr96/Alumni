<?php 
namespace Fuel\Migrations;

class Lists
{

    function up()
    {
        \DBUtil::create_table('lists', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'title' => array('type' => 'varchar', 'constraint' => 100),
            
            
        ), array('id'));
    }

    function down()
    {
       \DBUtil::drop_table('lists');
    }
}