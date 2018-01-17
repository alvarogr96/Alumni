<?php 
namespace Fuel\Migrations;
class Eventos
{
    function up()
    {
        \DBUtil::create_table('eventos', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'tipo' => array('type' => 'varchar', 'constraint' => 100),
            'titulo' => array('type' => 'varchar', 'constraint' => 100),
            'descripcion' => array('type' => 'int', 'constraint' => 100),
            'id_usuario' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'claveAjenaEventosAUsuarios',
		            'key' => 'id_usuario',
		            'reference' => array(
		                'table' => 'usuarios',
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
       \DBUtil::drop_table('eventos');
    }
}