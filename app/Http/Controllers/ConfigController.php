<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{


    public function show(Request $request)
    {
        return $request->user()->config ?: [];
    }


    public function update(Request $request)
    {
        $config = $request->user()->config;
        if (!$config) {
            $config = $request->user()->config()->create();
        }
        $config->twilio_account_sid = $request->twilio_account;
        $config->twilio_auth_token = $request->twilio_token;
        $config->twilio_number = $request->twilio_number;
        $config->save();
        return $config;
    }
}
