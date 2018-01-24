<?php 

use Firebase\JWT\JWT;

class Controller_Users extends Controller_Rest
{

    private $key = "dejr334irj3irji3r4j3rji3jiSj3jri";


    public function post_create()
    {
        try {
            
            if ( empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Falta algun campo'
                ));
                return $json;
            }

            // Mínimo caracteres
            if (strlen($_POST['username']) < 4)
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'El nombre debe contener cuatro caracteres minimo',
                    'data' => []
                ));
                return $json;
            }

            $input = $_POST;
            $user = new Model_Users();
            $user->username = $input['username'];
            $user->email = $input['email'];
            $user->password = $input['password'];
            $user->image_profile = 'alvaroiocld';
            $user->id_rol = 2;
            $user->id_list = 1;
            $user->save();
            $json = $this->response(array(
                'code' => 200,
                'message' => 'Usuario creado',
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
        
    public function post_emailValidate()
    {
        try {

            if ( empty($_POST['email'])) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Email no introducido',
                    'data' => []
                ));
                return $json;
            }

            // Validación de e-mail
            $input = $_POST;
            $users = Model_Users::find('all', array(
                'where' => array(
                    array('email', $input['email'])
                )
            ));

            if ( ! empty($users) )
            {
                foreach ($users as $key => $value)
                {
                    $id = $users[$key]->id;
                    $email = $users[$key]->email;
                }
            }
            else
            {
                return $this->response(array(
                    'code' => 400,
                    'message' => 'El email no existe'
                    ));
            }

            if ($email == $input['email'])
            {
                $json = $this->response(array(
                    'code' => 200,
                    'message' => 'El email existe',
                    'data' => ['email' => $email, 'token' => $token]
                ));
                return $json;
            }
        }
        catch (Exception $e)
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => 'Error de servidor'
                //'message' => $e->getMessage(),
            ));
            return $json;
        }
    }

    public function post_delete()
    {
        $user = Model_Users::find($_POST['id']);
        $userName = $user->username;
        $user->delete();
        $json = $this->response(array(
            'code' => 200,
            'message' => 'usuario borrado',
            'data' => $userName
        ));
        return $json;
    }

     public function get_users()
    {
        $users = Model_Users::find('all');
        return $this->response(Arr::reindex($users));
    }

    public function get_login()
    { 
        try {

                if ( empty($_GET['username']) || empty($_GET['password']))
                {
                    return $this->response(array(
                        'code' => 400,
                        'message' => 'Existen campos vacíos'
                    ));
                }

                $input = $_GET;
                $users = Model_Users::find('all', array(
                    'where' => array(
                        array('username', $input['username']),array('password', $input['password'])
                    )
                ));

                if ( ! empty($users) )
                {
                    foreach ($users as $key => $value)
                    {
                        $id = $users[$key]->id;
                        $username = $users[$key]->username;
                        $password = $users[$key]->password;
                    }
                }
                else
                {
                    return $this->response(array(
                        'code' => 400,
                        'message' => 'Usuario y/o contraseña incorrectos'
                        ));
                }

                if ($username == $input['username'] and $password == $input['password'])
                {
                    $dataToken = array(
                        "id" => $id,
                        "username" => $username,
                        "password" => $password
                    );
                    $token = JWT::encode($dataToken, $this->key);
                        return $this->response(array(
                            'code' => 200,
                            'message'=> 'Login Correcto',
                            'data' => ['token' => $token, 'username' => $username, 'image_profile' => 'alvaroiocld']
                        ));
                }
            }
            catch (Exception $e)
            {
                $json = $this->response(array(
                    'code' => 500,
                    'message' => 'Error de servidor'
                    //'message' => $e->getMessage(),
                ));
                return $json;
            }
        }                
}