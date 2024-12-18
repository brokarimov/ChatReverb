<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('index', ['messages' => $messages]);
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'text' => 'required',
                'image' => 'required'
            ]
        );
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('image_upload/', $filename);
            $data['image'] = 'image_upload/' . $filename;
        }

        $message = Message::create($data);
        broadcast(new MessageEvent($message));
        return back();
    }
}
