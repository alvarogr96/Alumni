<?php 
class Model_Events extends Orm\Model
{
    protected static $_table_name = 'events';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'type' => array(
            'data_type' => 'varchar'   
        ),
        'tittle' => array(
            'data_type' => 'varchar'   
        ),
        'description' => array(
            'data_type' => 'varchar'   
        ),
        'id_user'
    );
