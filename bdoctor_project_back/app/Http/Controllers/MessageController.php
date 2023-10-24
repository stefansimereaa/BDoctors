<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)

    {
        $data = $request->all();
        $message = new Message;
        $message->fill($data);
        // Genera una data casuale tra gennaio 2022 e dicembre 2022
        // $startDate = strtotime('2022-11-01');
        // $endDate = strtotime('2023-10-31');
        $timestamp = now();
        $message['date'] = $timestamp;
        $message->save();
    }
}
