<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */



    function get_headers_from_curl_response($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                if(!array_key_exists($key, $headers))
                    $headers[$key] = $value;
            }
        return $headers;
    }


    
    protected function redirectTo($request)
    {

        if (! $request->expectsJson()) {
            return route('login');
        }


        $username = $user->email;
        $password = $user->password;


        //when user exists
        //$my_login = file_get_contents("https://www.desarrollo.aspefam.org.pe/login/");
        $my_login = file_get_contents("https://www.desarrollo.aspefam.org.pe/login/index.php");
        preg_match_all('/<input type=\"hidden\" name=\"logintoken\" value=\"(.*?)\">/', $my_login, $logintoken);
        
        @$token = $logintoken[1][0];

        if(!empty($logintoken[1])){
            $token = $logintoken[1][0];
        }

        $cookies = array();
        foreach ($http_response_header as $hdr) {
                if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
                        parse_str($matches[1], $tmp);
                        $cookies += $tmp;
                }
        }

        $moodle_session = ($cookies['MoodleSession']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.desarrollo.aspefam.org.pe/login/index.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,sprintf("anchor=&username=%s&password=%s&logintoken=%s", trim($username), trim($password), trim($token)));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Cookie: MoodleSession='.$moodle_session.';'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        $headers = get_headers_from_curl_response($response);
        $_SESSION["MoodleSession_Shared"] = $headers['Set-Cookie'];

        $data = array("error" => "0","secure"=>$headers['Set-Cookie'], "ruta" => "");
    }
}
