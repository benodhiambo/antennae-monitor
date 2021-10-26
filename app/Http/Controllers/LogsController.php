<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function accessLogs()
    {
        $accessLogs = Log::where('type', 'access')->orderBy('created_at','desc')->get();
        return view('logs.access_logs', compact('accessLogs'));

    }

    public function createLogs()
    {
        $accessLogs = Log::where('type', 'create')->orderBy('created_at','desc')->get();
        return view('logs.access_logs', compact('accessLogs'));

    }

    public function deleteLogs()
    {
        $deleteLogs = Log::where('type', 'delete')->orderBy('created_at','desc')->get();
        return view('logs.delete_logs', compact('deleteLogs'));

    }

    public function updateLogs()
    {
        $updateLogs = Log::where('type', 'update')->orderBy('created_at','desc')->get();
        return view('logs.update_logs', compact('updateLogs'));

    }
}
