<?php

namespace App\Http\Controllers;

use App\Models\Bakid\Room;
use Illuminate\Http\Request;
use App\Models\Bakid\Dormitory;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreRoomRequest;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated());
        Toast::success('Asrama Berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $daerah  = Dormitory::all();
        return view('bakid.dormitory.show-room', compact('room', 'daerah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'dormitory_id' => 'required',
            'capacity' => 'required',
        ]);
        $isExist = Room::where('name', $request->name)->where('dormitory_id', $request->dormitory_id)->first();
        if ($request->name != $room->name) {
            if ($isExist) {
                Toast::danger('Nama Asrama sudah ada, di daerah tersebut!')->autoDismiss(2);
            } else {
                $room->update($request->all());
                Toast::success('Asrama Berhasil diupdate!')->autoDismiss(2);
            }
        } else {
            $room->update($request->all());
            Toast::success('Asrama Berhasil diupdate!')->autoDismiss(2);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
