<?

use Firebase\JWT\JWT;

class Controller_Board extends Controller_Rest
{
	public function post_create()
	{
		try
		{
			if ( empty($_POST['type']) || empty($_POST['title']) || empty($_POST['description']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Existen campos vacíos',
                    'data' => []
                ));
                return $json;
            }

            $input = $_POST;
            $user = new Model_Board();
            $user->type = $input['type'];
            $user->title = $input['title'];
            $user->description = $input['description'];
            $user->save();
            $json = $this->response(array(
                'code' => 200,
                'message' => 'Evento creado',
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