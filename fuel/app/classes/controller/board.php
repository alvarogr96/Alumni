<?php

use Firebase\JWT\JWT;

class Controller_Board extends Controller_Base
{
	public function post_create()
	{
		/*$this->respuesta(500, 'trace');
        exit;*/

        try
		{
			if ( empty($_POST['type']) || empty($_POST['title']) || empty($_POST['description']) || empty($_POST['localization']) || empty($_POST['destination']) || empty($_POST['link'])) 
            {
                $this->respuesta(400, 'Existen campos vacíos');
            }

            $input = $_POST;
            $user = new Model_Board();
            $user->type = $input['type'];
            $user->title = $input['title'];
            $user->description = $input['description'];
            $user->localization = $input['localization'];
            $user->destination = $input['destination'];
            $user->link = $input['link'];
            $user->save();
            $json = $this->response(array(
                'code' => 200,
                'message' => 'Anuncio creado',
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
}