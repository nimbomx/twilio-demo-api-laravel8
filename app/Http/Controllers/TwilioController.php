<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    public function callme() {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = "AC6d6096c1c8079b25532df7900d1d8350";
        $token  = "d30bf47e27df4f7964be75caf8a4677b";
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
        // $auth_token = "AC6d6096c1c8079b25532df7900d1d8350";
        
        // A Twilio number you own with Voice capabilities
        //$twilio_number = "+18087935960";
        
        //$twilio_number = "+12107916676";
        
        $TWILIO_NUMBER = "+523319309269";
        
        // Where to make a voice call (your cell phone?)
        
        $to_number = "+524448496307";
        
        $client = new Client($sid, $token);
        $client->account->calls->create(  
        $to_number,
        $TWILIO_NUMBER,
        array(
            "url" => "http://demo.twilio.com/docs/voice.xml"
            )
        );
    
        return 'Calling...';
    }
    
}
