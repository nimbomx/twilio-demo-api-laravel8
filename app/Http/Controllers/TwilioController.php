<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    public function callme(Request $request) {
        $ACCOUNT_SID    = env('TWILIO_ACCOUNT_SID');
        $AUTH_TOKEN  = env('TWILIO_AUTH_TOKEN');
        $TWILIO_NUMBER = env('TWILIO_NUMBER');
        
        $to_number = $request->number;
        
        $client = new Client($ACCOUNT_SID, $AUTH_TOKEN);

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
