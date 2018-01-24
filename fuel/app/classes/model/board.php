<?php 
class Model_Board extends Orm\Model
{
    protected static $_table_name = 'board';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'type' => array(
            'data_type' => 'varchar'   
        ),
        'title' => array(
            'data_type' => 'varchar'   
        ),
        'description' => array(
            'data_type' => 'varchar'   
        ),
        'localization' => array(
            'data_type' => 'varchar'   
        ),
        'destination' => array(
            'data_type' => 'varchar'   
        ),
        'link' => array(
            'data_type' => 'varchar'   
        ),
        'id_user'
    );
    
    protected static $_belongs_to = array(
        'users' => array(
            'key_from' => 'id_user',
            'model_to' => 'Model_Users',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );
}