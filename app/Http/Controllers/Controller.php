<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Option;
use Cookie;
use GuzzleHttp\Client;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
   	
    public function checkTable(){
    	$options = Option::all();
    	return view('table',compact('options'));

    }
    public function checkDate(Request $request){
    	$options = Option::where('value', '>='  ,'500k');
    	return  response()->json($options) ;
    }
   	public function index(){
   		$user = User::all();
   		// return  response()->json($user) ;
   		 return view('index',compact('user'));
   	}
	public function listAccount(Request $request){
			$data = $request->all();
			$client = new Client([
	            'base_uri' => asset('')
		    ]);
			$response = $client->request('GET', 'https://api.tdameritrade.com/v1/userprincipals', [
		        'headers' => [
		            'Accept' => 'application/json',
		            'Authorization' => 'Bearer '.$data['remember_token'],
		        ],
		        
		    ]);
		    $user_rp =  json_decode((string) $response->getBody(), true);
	   		return  response()->json($user_rp) ;
   	}


    public function getNext(){
    	return view('next');
    }
    public function postNext(Request $request){
		$user = new User;
		$user->remember_token = $request->access_token;
		$user->refresh_token =$request->refresh_token;
		$user->name = $request->scope;
		$user->expires_in = $request->expires_in;
		$user->refresh_token_expires_in =  $request->refresh_token_expires_in;
		$user->token_type =$request->token_type;
		$user ->save();
		
		return "<script>
			window.close(); 
       </script>";
    }
    public function callback(Request $request){
    	$access_token = '';
    	$http = new \GuzzleHttp\Client;
	    $response = $http->post('https://api.tdameritrade.com/v1/oauth2/token', [
	        'headers' => [
	            'Accept' => 'application/json',
	        ],
	        'form_params' => [
	            'grant_type' => 'authorization_code',
	            'access_type' => 'offline',
	            'client_id' => 'DGHJRW6FSYTBG15MSPLMEW4VKXKPM0GW',
	            'redirect_uri' => 'https://app_bearer.localhost/callback',
	            'code' =>$request->code,
	        ],
	    ]);
	    $data = json_decode((string) $response->getBody(), true);
	    $access_token = $data['access_token'];
    	$client = new Client([
            'base_uri' => asset('')
	    ]);
	    $response = $client->request('GET', 'https://api.tdameritrade.com/v1/userprincipals', [
	        'headers' => [
	            'Accept' => 'application/json',
	            'Authorization' => 'Bearer '.$access_token,
	        ],
	        
	    ]);
	    $user_rp =  json_decode((string) $response->getBody(), true);
	    $user_id = User::where('accountId', $user_rp['accounts'][0]['accountId'])->first();
		if ($user_id == null) {
		    $user = new User;
		    $user->accountId = $user_rp['accounts'][0]['accountId'];
			$user->name = $user_rp['accounts'][0]['displayName'];
			$user->refresh_token =$data['refresh_token'];
			$user->remember_token =$data['access_token'];
			$user->tokenExpirationTime =$user_rp['tokenExpirationTime'];
			$user ->save();

		} else {
			
			$user = User::where('accountId', $user_rp['accounts'][0]['accountId'])
      		 ->update(
      		 [
      		 	'name' => $user_rp['accounts'][0]['displayName'],
      		 	'remember_token'  => $user_rp['authToken'],
				'refresh_token'  => $data['refresh_token'],      		 	
				'tokenExpirationTime'   => $user_rp['tokenExpirationTime'],

      		 ]);
        
		}
		return "<script>
			window.close(); 
       </script>";
	 	
    }
}
