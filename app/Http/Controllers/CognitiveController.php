<?php

namespace App\Http\Controllers;

use CognifitSdk\Api\UserStartSession;
use CognifitSdk\Api\UserAccessToken;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\CognifitRequest;

class CognitiveController extends Controller
{
    private string $userToken      = 'USER_ACCESS_TOKEN';
    private string $clientHash     = '';
    private string $callbackUrl    = 'http://www.callback.test/testing';

    public function index()
    {
        $CLIENT_ID="e452c70e88d804d2396b06a78f3da0ce";
        $CLIENT_SECRET="953a5b98beb97a7d130093cf6a7d93dc";
        $CLIENT_HASH='';
        $cognifitUserToken = "sXvLZnqhoi9hkhFzmrXyF1hdONf9W1Bktty7RnDSmb9TfjSoWNrz/svP6tfygY3eSWadE4XU4hctUL9HNdSZWg==";
        $cognifitApiUserAccessToken = new UserAccessToken(
           $CLIENT_ID,
           $CLIENT_SECRET
        );
        $userStartSession   = new UserStartSession($CLIENT_ID, '', true, $CLIENT_HASH);
        $urlToStartSession  = $userStartSession->getUrlStartCognifit($cognifitUserToken, $this->callbackUrl,'DRIVING');
        //print_r($urlToStartSession);
        // $CLIENT_ID="e452c70e88d804d2396b06a78f3da0ce";
        // $CLIENT_SECRET="953a5b98beb97a7d130093cf6a7d93dc";
        // $CLIENT_HASH='';
        // $cognifitUserToken = "sXvLZnqhoi9hkhFzmrXyF1hdONf9W1Bktty7RnDSmb9TfjSoWNrz/svP6tfygY3eSWadE4XU4hctUL9HNdSZWg==";
        // $cognifitApiUserAccessToken = new UserAccessToken(
        //    $CLIENT_ID,
        //    $CLIENT_SECRET
        // );
        // //print_r($cognifitApiUserAccessToken);
        // $response = $cognifitApiUserAccessToken->issue($cognifitUserToken);
        // //print_r($response);
        // if(!$response->hasError()){
        //     $CLIENT_HASH= $response->get('access_token');
        // }
        // $cognifitStartSession = new UserStartSession(
        //     $CLIENT_ID,
        //     $CLIENT_SECRET,
        //     false,
        //     $CLIENT_HASH
        // );
        // $userAccessToken    = $cognifitUserToken;
        // $callbackUrl        = '';
        
        // //$url = $cognifitStartSession->getUrl($userAccessToken, $callbackUrl);
        // //userStartSession

        // $userStartSession   = new UserStartSession($CLIENT_ID, '', true, $CLIENT_HASH);
        // //$urlToStartSession  = $userStartSession->get
        // $urlToStartSession  = $userStartSession->getUrlStartCognifitForTraining($this->userToken, $this->callbackUrl, 'DRIVING');   
        // print_r($urlToStartSession);
        //return  redirect()->away($urlToStartSession);

       return $urlToStartSession;
    }
    public function index_driving()
    {
        $CLIENT_ID="e452c70e88d804d2396b06a78f3da0ce";
        $CLIENT_SECRET="953a5b98beb97a7d130093cf6a7d93dc";
        $CLIENT_HASH='';
        $cognifitUserToken = "sXvLZnqhoi9hkhFzmrXyF1hdONf9W1Bktty7RnDSmb9TfjSoWNrz/svP6tfygY3eSWadE4XU4hctUL9HNdSZWg==";
        $cognifitApiUserAccessToken = new UserAccessToken(
           $CLIENT_ID,
           $CLIENT_SECRET
        );
        $userStartSession   = new UserStartSession($CLIENT_ID, '', true, $CLIENT_HASH);
        $urlToStartSession  = $userStartSession->getUrlStartCognifit($cognifitUserToken, $this->callbackUrl,'DRIVING');
       return $urlToStartSession;
    }
    public function index_training()
    {
        $CLIENT_ID="e452c70e88d804d2396b06a78f3da0ce";
        $CLIENT_SECRET="953a5b98beb97a7d130093cf6a7d93dc";
        $CLIENT_HASH='';
        $cognifitUserToken = "sXvLZnqhoi9hkhFzmrXyF1hdONf9W1Bktty7RnDSmb9TfjSoWNrz/svP6tfygY3eSWadE4XU4hctUL9HNdSZWg==";
        $cognifitApiUserAccessToken = new UserAccessToken(
           $CLIENT_ID,
           $CLIENT_SECRET
        );
        $userStartSession   = new UserStartSession($CLIENT_ID, '', true, $CLIENT_HASH);
        $urlToStartSession  = $userStartSession->getUrlStartCognifit($cognifitUserToken, $this->callbackUrl,'DRIVING_ASSESSMENT');
       return $urlToStartSession;
    }
    public function index_task()
    {
        $CLIENT_ID="e452c70e88d804d2396b06a78f3da0ce";
        $CLIENT_SECRET="953a5b98beb97a7d130093cf6a7d93dc";
        $CLIENT_HASH='';
        $cognifitUserToken = "sXvLZnqhoi9hkhFzmrXyF1hdONf9W1Bktty7RnDSmb9TfjSoWNrz/svP6tfygY3eSWadE4XU4hctUL9HNdSZWg==";
        $cognifitApiUserAccessToken = new UserAccessToken(
           $CLIENT_ID,
           $CLIENT_SECRET
        );
        $userStartSession   = new UserStartSession($CLIENT_ID, '', true, $CLIENT_HASH);
        $urlToStartSession  = $userStartSession->getUrlStartCognifit($cognifitUserToken, $this->callbackUrl,'MAHJONG');
       return $urlToStartSession;
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $Cognitive = Cognitive::create($request->all());
        return response()->json($Cognitive, 201);
    }

    public function show($id)
    {
        $Cognitive = Cognitive::find($id);
        
        if (!$Cognitive) {
            return response()->json(['message' => 'Cognitive no encontrado'], 404);
        }
        
        return response()->json($Cognitive);
    }

    public function update(Request $request, $id)
    {
        $Cognitive = Cognitive::find($id);
        
        if (!$Cognitive) {
            return response()->json(['message' => 'Cognitive no encontrado'], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:250'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $Cognitive->update($request->all());
        return response()->json($Cognitive);
    }

    public function destroy($id)
    {
        $Cognitive = Cognitive::find($id);
        
        if (!$Cognitive) {
            return response()->json(['message' => 'Cognitive no encontrado'], 404);
        }
        
        $Cognitive->delete();
        return response()->json(['message' => 'Cognitive eliminado correctamente']);
    }
    public function accesstoken()
    {
        $CLIENT_ID="e452c70e88d804d2396b06a78f3da0ce";
        $CLIENT_SECRET="953a5b98beb97a7d130093cf6a7d93dc";
        $cognifitUserToken = "sXvLZnqhoi9hkhFzmrXyF1hdONf9W1Bktty7RnDSmb9TfjSoWNrz/svP6tfygY3eSWadE4XU4hctUL9HNdSZWg==";
        $cognifitApiUserAccessToken = new UserAccessToken(
           $CLIENT_ID,
           $CLIENT_SECRET
        );
        //print_r($cognifitApiUserAccessToken);
        $response = $cognifitApiUserAccessToken->issue($cognifitUserToken);
        //print_r($response);
        if(!$response->hasError()){
            return $response->get('access_token');
        }
        return   'resut';
    }
}
