<?php 
class Model_types extends Orm\Model
{
    protected static $_table_name = 'types';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'name' => array(
            'data_type' => 'varchar'   
        ),
    );
    protected static $_has_many = array(
        'users' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Board',
            'key_to' => 'id_type',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );
}