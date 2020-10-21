<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserMoodle;
use App\Models\CourseMoodle;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ZoomController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$user_id = \Auth::user()->id; //auth()->id();
        $usuario = usermoodle::where('id', $user_id)->first();

		return view('zoom', compact('usuario'));
	}

    private function is_table_empty() {
        $result = \DB::table('token')->select('id');
        if($result->count()) {
            return false;
        }
  
        return true;
    }
  
    private function get_access_token() {
        $sql = \DB::table('token')->select('access_token')->get();
        $result = $sql->toArray();
        return json_decode($result['access_token']);
    }
  
    private function get_refresh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    private function update_access_token($token) {
        if($this->is_table_empty()) {
            \DB::query("INSERT INTO token(access_token) VALUES('$token')");
        } else {
            \DB::query("UPDATE token SET access_token = '$token' WHERE id = (SELECT id FROM token)");
        }
    }

    function create_meeting() {
	    $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
	 
	    $arr_token = $this->get_access_token();
	    $accessToken = $arr_token->access_token;
	 
	    try {
	        $response = $client->request('POST', '/v2/users/me/meetings', [
	            "headers" => [
	                "Authorization" => "Bearer $accessToken"
	            ],
	            'json' => [
	                "topic" => "Let's learn Laravel",
	                "type" => 2,
	                "start_time" => "2020-05-05T20:30:00",
	                "duration" => "30", // 30 mins
	                "password" => "123456"
	            ],
	        ]);
	 
	        $data = json_decode($response->getBody());
	        echo "Join URL: ". $data->join_url;
	        echo "<br>";
	        echo "Meeting Password: ". $data->password;
	 
	    } catch(Exception $e) {
	        if( 401 == $e->getCode() ) {
	            $refresh_token = $this->get_refresh_token();
	 
	            $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
	            $response = $client->request('POST', '/oauth/token', [
	                "headers" => [
	                    "Authorization" => "Basic ". base64_encode(env('CLIENT_ID').':'.env('CLIENT_SECRET'))
	                ],
	                'form_params' => [
	                    "grant_type" => "refresh_token",
	                    "refresh_token" => $refresh_token
	                ],
	            ]);
	            $this->update_access_token($response->getBody());
	 
	            create_meeting();
	        } else {
	            echo $e->getMessage();
	        }
	    }
	}

	function delete_meeting()
	{
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
 
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token->access_token;
		 
		$response = $client->request('DELETE', '/v2/meetings/{meeting_id}', [
		    "headers" => [
		        "Authorization" => "Bearer $accessToken"
		    ]
		]);
	}

	function callback()
	{
		try {
		    $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
		 
		    $response = $client->request('POST', '/oauth/token', [
		        "headers" => [
		            "Authorization" => "Basic ". base64_encode(env('CLIENT_ID').':'.env('CLIENT_SECRET'))
		        ],
		        'form_params' => [
		            "grant_type" => "authorization_code",
		            "code" => $_GET['code'],
		            "redirect_uri" => env('REDIRECT_URI')
		        ],
		    ]);
		 
		    $token = json_decode($response->getBody()->getContents(), true);
		 
		    if($this->is_table_empty()) {
		        $this->update_access_token(json_encode($token));
		        echo "Access token inserted successfully.";
		    }
		} catch(Exception $e) {
		    echo $e->getMessage();
		}
	}
}
