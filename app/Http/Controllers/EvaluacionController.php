<?php

namespace App\Http\Controllers;
use App\Models\Position;
use App\Models\PositionUser;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalAccessToken;
use App\Mail\InvitedPositionTemplate;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionMailable;

class EvaluacionController extends Controller
{

    public function sendinvitation(Request $request)
    {
        $id = $request->position_id;
        $position_user = $request->position_user_id;
       // $esarr = is_numeric($position_user);
        $position = Position::find($id);
        $data=[];
        if ($position) {
            if (is_numeric($position_user)){
                $user = User::find($position_user);
                $token = $user->createToken('auth_token')->plainTextToken;
                $data[]=[
                    'user_id' => $position_user,
                    'position' => $position->name,
                    'position_id' => $id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token,
                ];
                Mail::to($user->email)->send(new NotificacionMailable($user->name, $position->name,$id,$token,$user->id, 'Has sido invitado a un proceso'));
            }else {
                foreach ($position_user as $value) {
                    $user = User::find($value);
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $data[]=[
                        'user_id' => $value,
                        'position' => $position->name,
                        'position_id' => $id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'token' => $token,
                    ];
                    Mail::to($user->email)->send(new NotificacionMailable($user->name, $position->name,$id,$token,$user->id, 'Has sido invitado a un proceso'));
                    //Mail::to($user->email)->send(new InvitedPositionTemplate($user->name, $position->name,$id,$token, 'Recordatorio: Has sido invitado a un proceso'));
                }
            }
            
           
            return $data;
        } else {
            return response()->json([
                'message' => 'El puesto no existe.'
            ], Response::HTTP_BAD_REQUEST);
        }
        return $position;
    }
     /**
     * Mostrar datos del evaluado, segun su accesstoken.
     */
    public function show(Request $request)
    {
         $token = $request->access_token;
         $positionid= $request->position_id;
         $userid= $request->uid;
         //$result = DB::table('personal_access_tokens')->get();
         //$result = DB::table('personal_access_tokens')->where('token', $token)->firstOrFail();
        // $personaltoken = DB::table('personal_access_tokens')->where('token', $token)->get();
        //$user ==DB::table('users')->find($userid);
        $user = User::find($userid);
         if (!$user) {
            return response()->json([
                'message' => 'Credenciales inválidas.'
            ], Response::HTTP_UNAUTHORIZED);
         }else {
            //$userid=$personaltoken[0]->tokenable_id;
            //$user =DB::table('users')->find($userid);
            // $result = DB::table('personal_access_tokens')
            //             // ->select('document_type'
            //             // ,'document_number'
            //             // ,'email'
            //             // ,'name'
            //             // ,'lastname')
            //             ->join('users', 'users.id', '=', 'personal_access_tokens.tokenable_id')
            //             ->where('personal_access_tokens.token', $token)
            //             ->get();
            
           // return $user;
            //$position =DB::table('positions')->find($positionid);
            $position =DB::table('positions')
                ->where('positions.id', $positionid)
                ->get();  
            $skills = DB::table('positions')
                        // ->select('document_type'
                        // ,'document_number'
                        // ,'email'
                        // ,'name'
                        // ,'lastname')
                        ->join('position_skills', 'position_skills.position_id', '=', 'positions.id')
                        ->where('positions.id', $positionid)
                        ->get();                        
            //return $position;
            return response()->json([
                
                    'id' => $user->id,
                    'name' => $user->name,
                    'lastname' => $user->lastname,
                    'role' => $user->role,
                    'type' => $user->document_type,
                    'document' => $user->document_number,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'token' => $token,
                    'position'=>$position,
                    'skillls'=> $skills
            ], 200);
         }

         //$accessToken = PersonalAccessToken::findToken($token);
        // $personal = PersonalAccessToken::where('token', $token)->first();

       // $user = PersonalAccessTokens::where('token', $request->access_token)->first();
        // return $user;
       
    }
    public function store(Request $request)
    {
       // return $request;
        $position_user_id = $request->position_user_id;
        $skill_id = $request->skill_id;
        $result = $request->result;
        $status = $request->status;

       
        $user_result=DB::table('position_user_skill_results')->insert([
            [
            'position_user_id' => $position_user_id
            , 'skill_id' => $skill_id
            , 'result' => $result
            , 'status' => $status
            , 'created_at' => now()
        ], 
        ]);
        if ($user_result) {
            return response()->json([
                'data' => $user_result,
                'message' => 'Resultado cargado exitosamente.'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No se pudo completar la solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
