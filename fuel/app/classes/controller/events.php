<?

use Firebase\JWT\JWT;

class Controller_Events extends Controller_Rest
{
	public function post_create()
	{
		try
		{
			if ( empty($_POST['type']) || empty($_POST['tittle']) || empty($_POST['description']) ) 
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Existen campos vacíos'
                ));
                return $json;
            }

            $input = $_POST;
            $user = new Model_Events();
            $user->type = $input['type'];
            $user->title = $input['tittle'];
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