<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Services\Response;
use App\Messages;
use DB;

class MessageController extends Controller
{
    public function index()
    {
        $data = DB::table('messages')->orderBy('created_at','desc')->paginate(5);
        return view('page/dashboard/index', compact('data'));
    }

    //
     /**
     * Dispatch Order to Driver
     */
    public function sendsms(Request $request)
    {
        //validation for parameter
        $validator= Validator::make($request->all(),[
            'from'        => "required|string",
            'to'          => "required|string",
            'message'     => "required|string"
        ]);

        //if validation error
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'status' => 401,
                'error'=>$validator->errors()
            ], 401);
        }

        //access api client to send sms;
        $client = new Client();
        $request2 = $client->request('POST','http://www.myvaluefirst.com/smpp/sendsms',[
            'form_params' => [
                'username' => 'demoindo1',
                'password' => 'http1313',
                'to'       => $request->input('to'),
                'from'     => $request->input('from'),
                'text'     => $request->input('message')
            ]
        ]);

        $response = $request2->getBody()->getContents();
        if($response == 'Sent.'){
            // "if sms success";
            $save_msg = Messages::create([
                'to' => $request->to,
                'from'  => $request->from,
                'message' => $request->message,
                'message_info' => $response,
                'msg_status'     => true
            ]);

            //response when success
            return response()->json([
                'success' => true,
                'status' => 200,
                'data'=> $response
            ]);

        }else{
            // "if sms failed";
            $save_msg = Messages::create([
                'to' => $request->to,
                'from'  => $request->from,
                'message' => $request->message,
                'message_info' => $response,
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
