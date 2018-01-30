<?php

use Firebase\JWT\JWT;

class Controller_Board extends Controller_Rest
{
    private $key = "dejr334irj3irji3r4j3rji3jiSj3jri";

    public function get_types()
    {
        $types = Model_types::find('all');
        return $this->response(Arr::reindex($types));
    }

	public function post_create()
	{
		try
		{   
            /*hacer metodo validar token para poder usarlo en cada endpoint*/
            try
            {
                $this->tokenValidate();
            }
            catch (Exception $e)
            {
                $json = $this->response(array(
                    'code' => 500,
                    'message' => $e->getMessage()
                ));
                return $json;
            }

            if (($_POST['id_type']) > 4 || ($_POST['id_type']) < 1 )
            {
                $json = $this->response(array(
                'code' => 400,
                'message' => 'Tipo de anuncio no encontrado',
                'data' => []
                ));
                return $json;
            }

            if(($_POST['group']) != 1)
            {
                $json = $this->response(array(
                'code' => 400,
                'message' => 'Grupo no existe',
                'data' => []
                ));
                return $json;
            }

            $title = $_POST['title'];
            $description = $_POST['description'];
            $group = $_POST['group'];

            if($this->isBoardCreated($title, $description, $group))
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'Este anuncio ya existe',
                    'data' => []
                ));
                return $json;
            }

			if ( empty($_POST['id_type']) || empty($_POST['title']) || empty($_POST['description']) || empty($_POST['group']) )
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Existen campos vacíos',
                    'data' => []
                ));
                return $json;
            }
            else
            {
                $input = $_POST;
                $board = new Model_Board();
                $board->id_type = $input['id_type'];
                $board->title = $input['title'];
                $board->description = $input['description'];
                $board->group = $input['group'];

                /* isset de localization y link*/

                if (isset($input['localization']))
                {
                    $board->localization = $input['localization'];
                }
                if (isset($input['link']))
                {
                    $board->link = $input['link'];
                }

                $board->save();

                $json = $this->response(array(
                    'code' => 200,
                    'message' => 'Anuncio realizado',
                    'data' => $board
                ));
                return $json;
            }
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

    public function tokenValidate()
    {
        $headers = apache_request_headers();
        $token = $headers['Authorization'];
        $dataJwtUser = JWT::decode($token, $this->key, array('HS256'));

        $users = Model_Users::find('all', array(
            'where' => array(
                array('username', $dataJwtUser->username),
                array('password', $dataJwtUser->password)
            )
        ));

        if (empty($users))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_boards()
    {
        $board = Model_Board::find('all');
        return $this->response(Arr::reindex($board));
    }

    public function isBoardCreated($title, $description, $group)
    {
        $board = Model_Board::find('all', array(
            'where' => array(
                array('title', $title),
                array('description', $description),
                array('group', $group)
            )
        ));

        if($board != null)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
}