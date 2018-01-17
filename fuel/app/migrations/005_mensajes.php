<?php 
namespace Fuel\Migrations;
class Mensajes
{
    function up()
    {
        \DBUtil::create_table('mensajes', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'mensaje' => array('type' => 'varchar', 'constraint' => 100),
            'id_usuario_envia' => array('type' => 'int', 'constraint' => 11),
            'id_usuario_recibe' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'claveAjenaMensajesAUsuariosEnvia',
		            'key' => 'id_usuario_envia',
		            'reference' => array(
		                'table' => 'usuarios',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
		        array(
		            'constraint' => 'claveAjenaMensajesAUsuariosRecibe',
		            'key' => 'id_usuario_recibe',
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
       \DBUtil::drop_table('mensajes');
    }
}