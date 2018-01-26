<?php

namespace Fuel\Migrations;
class types
{
    function up()
    {
        \DBUtil::create_table('types', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'name' => array('type' => 'varchar', 'constraint' => 100),
        ), array('id'));
        \DB::query("INSERT INTO types (id,name) VALUES ('1','events');")->execute();
        \DB::query("INSERT INTO types (id,name) VALUES ('2','news');")->execute();
        \DB::query("INSERT INTO types (id,name) VALUES ('3','jobs');")->execute();
        \DB::query("INSERT INTO types (id,name) VALUES ('4','notifications');")->execute();
    }

    function down()
    {
       \DBUtil::drop_table('types');
    }
}