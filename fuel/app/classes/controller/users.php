<?php 

use Firebase\JWT\JWT;

class Controller_Users extends Controller_Rest
{

    public function post_config()
    {
        
    }



    public function post_create()
    {
   // private $key = "9adsfssads9sa97ass7as97as7d9";

        try {
            if ( empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Falta algun campo'
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
        $userName = $user->username;
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
       try {
            $input = $_GET;
            $users = Model_Users::find('all', array(
                'where' => array(
                    array('username', $input['username']),
                )
            ));
            // https://localhost:8888/userfuelphp/public/users/login.json?username=julio&password=1234
            
            if(!empty($users)){
                foreach ($users as $key => $value) {
                  $id = $users[$key]->id;
                  $username = $users[$key]->name;
                  $password = $users[$key]->password;
                }
            } 
            else {
                return $this->response(array(
                    'ErrorAut' => 400
                ));
            }
            
            if ($username == $input['username'] && $password == $input['password']){
                $datatoken = array(
                    'id' => $id,
                    'name' => $username,
                    'password' => $password
                );
                $token = JWT::encode($datatoken,$this->key);
                return $this->response(array(
                    'LoginBienHecho' => 200,
                     ['token' => $token, 'username' => $username]
                ));
            }
            else {
                return $this->response(array(
                    'ErrorAut' => 400
                ));
            }
        }
    catch (Exception $e){
        return $this->response(array(
            'ErrorServ' => 500
        ));
    }
    }
}