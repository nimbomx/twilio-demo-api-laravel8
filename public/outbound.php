<?php
require  '../vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;


function generate_twiml_response() {
    $salesPhone='+12107916676';
    if (array_key_exists('QUERY_STRING', $_SERVER)) {
        $queryArgs = array();
        parse_str($_SERVER['QUERY_STRING'], $queryArgs);
        $salesPhone = $queryArgs['phone'];
        $ID = $queryArgs['ID'];
    }

    $host = $_SERVER['HTTP_HOST'];

    $response = new VoiceResponse();
    $response->say('Please, hold in the line, until the provider answers');
            
    //$dial = $response->dial($salesPhone);
    //'statusCallbackEvent' => 'initiated ringing answered completed',
    $dial = $response->dial('');
    $dial->number($salesPhone,
    [
        "statusCallback" => "https://$host/api/twilio/provider_events/$ID",
        "statusCallbackEvent" => "initiated ringing answered completed",
        "statusCallbackMethod" => "POST"
    ]
    );
/*
    
*/
    return (string)$response;
}

print_r(generate_twiml_response());