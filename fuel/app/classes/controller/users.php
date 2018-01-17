<?php 

use Firebase\JWT\JWT;

class Controller_Users extends Controller_Rest
{
    public function post_create()
    {
   // private $key = "9adsfssads9sa97ass7as97as7d9";

        try {
            if ( empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['password']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Falta algun campo'
                ));
                return $json;
            }
            
           $input = $_POST;
            $user = new Model_Users();
            $user->nombre = $input['nombre'];
            $user->email = $input['email'];
            $user->password = $input['password'];
            $user->foto_perfil = 'alvaroiocld';
            $user->id_rol = 2;
            $user->id_lista = 1;
            $user->save();
            $json = $this->response(array(
                'code' => 200,
                'message' => 'usuario creado',
                'data' => $user
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
    public function post_recoverPass()
    {
        if ( empty($_POST['email'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Falta algun campo'
                ));
                return $json;
            }
    }

    public function post_delete()
    {
        $user = Model_Users::find($_POST['id']);
        $userName = $user->nombre;
        $user->delete();
        $json = $this->response(array(
            'code' => 200,
            'message' => 'usuario borrado',
            'data' => $userName
        ));
        return $json;
    }

     public function get_usuarios()
    {
        $users = Model_Users::find('all');
        return $this->response(Arr::reindex($users));
    }
 
    public function get_login()
    {
        if ( empty($_POST['nombre']) || empty($_POST['password']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Falta algun campo'
                ));
                return $json;
            }

        $users = Model_Users::find('all', array(
            'where' => array(
                array('nombre', $_POST['nombre']),
                array('password', $_POST['password']),
            )
        ));
        var_dump($users);
    }
}