<?php 
namespace Fuel\Migrations;

class Ajustes
{

    function up()
    {
        \DBUtil::create_table('ajustes', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'sonido' => array('type' => 'varchar', 'constraint' => 100),
            'notificaciones' => array('type' => 'varchar', 'constraint' => 100),
            'id_usuario' => array('type' => 'int', 'constraint' => 5),

            
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
            array(
                array(
                    'constraint' => 'claveAjenaAjustesAUsuarios',
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
       \DBUtil::drop_table('ajustes');
    }
}