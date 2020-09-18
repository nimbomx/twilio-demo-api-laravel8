<?php
require  '../vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;

$host = $_SERVER['HTTP_HOST'];
$id = 1;
$salesPhone = '+1210791 6676';
function generate_twiml_response() {

    $response = new VoiceResponse();
    $response->say('Please, hold in the line, until the provider answers');
            
    $dial = $response->dial('+12107916676');
    //'statusCallbackEvent' => 'initiated ringing answered completed',
   /* $dial->number($salesPhone,
    [
        "statusCallback" => "https://$host/api/twilio/provider_events/$id",
        "statusCallbackEvent" => "initiated ringing answered completed",
        "statusCallbackMethod" => "POST"
    ]
    );*/
/*
    
*/
    return (string)$response;
}

print_r(generate_twiml_response());