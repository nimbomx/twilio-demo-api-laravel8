<?php

namespace App\Http\Controllers;

use App\Models\Providers;
use Exception;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    public function callme(Request $request) {

        $provider = Providers::findOrFail($request->id);

        $to_number =  str_replace('-','',filter_var($provider->phone, FILTER_SANITIZE_NUMBER_INT));
        $ACCOUNT_SID    = env('TWILIO_ACCOUNT_SID');
        $AUTH_TOKEN  = env('TWILIO_AUTH_TOKEN');
        $TWILIO_NUMBER = env('TWILIO_NUMBER');
        
        
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
    public function connectCall(Request $request) {

        $myfile = fopen("$request->id.txt", "w");
        fwrite($myfile, "a:waiting...");
        fclose($myfile);

        $provider = Providers::findOrFail($request->id);

        $to_number =  str_replace('-','',filter_var($provider->phone, FILTER_SANITIZE_NUMBER_INT)); //GET THE MANAGER PHONE
        $ACCOUNT_SID    = env('TWILIO_ACCOUNT_SID');
        $AUTH_TOKEN  = env('TWILIO_AUTH_TOKEN');
        $TWILIO_NUMBER = env('TWILIO_NUMBER');
        
 
        $client = new Client($ACCOUNT_SID, $AUTH_TOKEN);

        $host = $_SERVER['HTTP_HOST'];

   
        
        $encodedSalesPhone = urlencode(str_replace('-','',filter_var($provider->phone, FILTER_SANITIZE_NUMBER_INT))); 
        //$outboundUri = "https://$host/api/twilio/outbound/$encodedSalesPhone/$request->id";
        $outboundUri = "https://$host/outbound.php";

        $myfile = fopen("$request->id.txt", "w");
        fwrite($myfile, "a:$outboundUri");
        fclose($myfile);

        try {
            $call = $client->calls->create(
                 $to_number,                 // The visitor's phone number
                 $TWILIO_NUMBER,    // A Twilio number in your account
                 [
                     "method" => "GET",
                     "url" => $outboundUri,   // public URL TwiML that handles the call
                     "statusCallback" => "https://$host/api/twilio/admin_events/$request->id",
                     "statusCallbackEvent" => ["initiated","ringing","answered","completed"],//"initiated ringing answered completed",
                     "statusCallbackMethod" => "POST",
                     
                     ]
                    );
                    
             print($call->sid);
         } catch (Exception $e) {
             // Failed calls will throw
             return 'ERROR:' . $e;
         }
    }

    public function outbound(Request $request,$phone,$id) {
        $host = $_SERVER['HTTP_HOST'];
        $salesPhone = '+524446039460';
        function generate_twiml_response() {
            $response = new VoiceResponse();
            $response->say('Please, hold in the line, until the provider answers');
            
            $dial = $response->dial('');
            //'statusCallbackEvent' => 'initiated ringing answered completed',
            $dial->number($salesPhone
            );
/*
            [
                "statusCallback" => "https://$host/api/twilio/provider_events/$id",
                "statusCallbackEvent" => "initiated ringing answered completed",
                "statusCallbackMethod" => "POST"
            ]
*/
            return (string)$response;
        }
        
        print_r(generate_twiml_response());
 
      
    }
    public function adminEvents(Request $request,$id) {

        $myfile = fopen("$id.txt", "w");
        fwrite($myfile, 'a:' . $request->CallStatus);
      
    }
    public function providerEvents(Request $request,$id) {

        $myfile = fopen("$id.txt", "w");
        fwrite($myfile, 'p:' . $request->CallStatus);
      
    }


    public function sse(Request $request,$id) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET');
        header("Access-Control-Allow-Headers: X-Requested-With");
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $file="$id.txt";
        
        $f = fopen($file, 'r');
        $status = fgets($f);
        fclose($f);
        
        echo "data: {$status}\n\n";
        ob_flush();
        flush();
    }

    
    
}
