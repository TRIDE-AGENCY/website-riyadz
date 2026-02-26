<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::when(request()->q, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request()->q . '%')
                  ->orWhere('message', 'like', '%' . request()->q . '%');
            });
        })->latest()->paginate(10);

        $messages->appends(['q' => request()->q]);

        return inertia('Admin/Message/Index', [
            'messages' => $messages,
        ]);
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $message->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.messages.index');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index');
    }
}
