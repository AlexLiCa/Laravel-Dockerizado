<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Import Request
use App\Models\DeviceLog; // Import DeviceLog model

Route::get('/', function (Request $request) { // Inject Request
    // Log the current request
    $log = new DeviceLog();
    $log->ip_address = $request->ip();
    $log->user_agent = $request->userAgent();
    $log->save();

    // Fetch all logs, newest first
    $deviceLogs = DeviceLog::latest()->get();

    // Pass logs to the view
    return view('welcome', ['deviceLogs' => $deviceLogs]);
});
