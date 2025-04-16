<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('dashboard', compact('rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'available' => 'required|integer|min:0'
        ]);

        $room = Room::findOrFail($id);
        $room->update([
            'price' => $request->price,
            'available' => $request->available
        ]);

        return redirect()->route('dashboard')->with('success', 'Data kamar berhasil diperbarui');
    }
}
