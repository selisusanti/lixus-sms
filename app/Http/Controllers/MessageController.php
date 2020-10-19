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
        // $data = Messages::paginate(5);
        $data = DB::table('messages')->paginate(5);
        return view('page/dashboard/index', compact('data'));
    }

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
            // "atas";
            
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
            // "bawah";
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
