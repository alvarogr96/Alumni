<?php

use Firebase\JWT\JWT;

class Controller_Board extends Controller_Rest
{

    public function get_types()
    {
        $types = Model_types::find('all');
        return $this->response(Arr::reindex($types));
    }

    public function post_chooseType()
    {
        $input = $_POST;
        $board = new Model_Board();
        
        $board->save();
        $json = $this->response(array(
                'code' => 200,
                'message' => 'Tipo seleccionado',
                'data' => $board
        ));
        return $json;
    }

	public function post_create()
	{
		try
		{   
            /*hacer metodo validar token para poder usarlo en cada enpoint*/

			if ( empty($_POST['title']) || empty($_POST['description']) || empty($_POST['group']) )
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
                $board->localization = $input['localization'];
                $board->link = $input['link'];
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
}