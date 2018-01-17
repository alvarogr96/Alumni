<?php 
class Controller_Users extends Controller_Rest
{
    public function post_create()
    {
        try {
            if ( ! isset($_POST['name']) && ! isset($_POST['password'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  $_POST['name']
                ));
                return $json;
            }
            
           $input = $_POST;
            $user = new Model_Users();
            $user->name = $input['name'];
            $user->password = $input['password'];
            $user->save();
            $json = $this->response(array(
                'code' => 200,
                'message' => 'usuario creado',
                'data' => $input['name']
            ));
            return $json;
        } 
        catch (Exception $e) 
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => $e->getMessage()
            ));
            return $json;
        }
        
    }
 
    public function get_login()
    {
        $users = Model_Users::find('all', array(
            'where' => array(
                array('name', $_POST['name']),
                array('password', $_POST['password']),
            )
        ));
        var_dump($users);
    }
}