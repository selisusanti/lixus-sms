<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Services\Response;
use App\Messages;

class MessageController extends Controller
{
    //
     /**
     * Dispatch Order to Driver
     */
    public function sendsms(Request $request)
    {

        $validator= Validator::make($request->all(),[
            'from'        => "required|string",
            'to'          => "required|string",
            'message'     => "required|string"
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }

        //disini;
        // $client = new Client();
        // $request = $client->request('POST','http://www.myvaluefirst.com/smpp/sendsms',[
        //     'form_params' => [
        //         'username' => 'demoindo1',
        //         'password' => 'http1313',
        //         'to'       => $request->to,
        //         'from'     => $request->from,
        //         'text'     => $request->message
        //     ]
        // ]);

        // $response = $request->getBody()->getContents();
            $response = "Sent.";
        if($response == 'Sent.'){
            // "atas";
            $save_msg= new Messages();
            $save_msg->to=$request->input('to');
            $save_msg->from=$request->input('from');
            $save_msg->message=$request->input('message');
            $save_msg->msg_status=true;
            $save_msg->save();   

            //response when success
            return response()->json([
                'success' => true,
                'status' => 200,
                'data'=> $response
            ]);
        }else{
            // "bawah";
            $save_msg = Messages::create([
                'to' => $request->to,
                'from'  => $request->from,
                'message' => $request->message,
                'msg_status'     => false
            ]);
            //response when failed
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'  => $response
            ]);
        }
        
    }
}
