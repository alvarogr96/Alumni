<?php

use Firebase\JWT\JWT;

class Controller_Board extends Controller_Rest
{

    public function get_types()
    {
        $board = Model_Board::find('all');
        return $this->response(Arr::reindex($board));
    }

	public function post_create()
	{
		try
		{
			if ( empty($_POST['type']) || empty($_POST['title']) || empty($_POST['description']) || empty($_POST['localization']) || empty($_POST['group']) || empty($_POST['link']) )
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Existen campos vacíos',
                    'data' => []
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