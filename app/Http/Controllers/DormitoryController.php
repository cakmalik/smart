<?php

namespace App\Http\Controllers;

use App\Models\Bakid\Room;
use Illuminate\Http\Request;
// use ProtoneMedia\Splade\Components\WithVue;
use App\Models\Bakid\Dormitory;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreDormitoryRequest;
use App\Http\Requests\UpdateDormitoryRequest;
use Illuminate\Http\Client\Request as ClientRequest;

class DormitoryController extends Controller
{
    // use WithVue;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rooms = Room::query();
        $rooms->when($request->input('dormitory_id'), function ($q) use ($request) {
            $q->where('dormitory_id', $request->dormitory_id);
        });
        $daerah = Dormitory::when($request->input('gender'), function ($q) use ($request) {
            $q->where('gender', $request->gender);
        })->orderBy('name', 'asc')->get();

        $rooms = $rooms->orderBy('name', 'asc')->get();
        return view('bakid.dormitory.index', compact('rooms', 'daerah'));
    }

    public function room($dormitory)
    {
        // $rooms = Room::where('dormitory_id', $dormitory)->get();
        // $daerah = Dormitory::all();
        // return view('bakid.dormitory.index', compact('rooms', 'daerah'));
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
    public function store(StoreDormitoryRequest $request)
    {
        Dormitory::create($request->validated());
        Toast::success('Daerah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dormitory $dormitory)
    {
        return view('bakid.dormitory.show-dormitory', compact('dormitory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dormitory $dormitory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dormitory $dormitory)
    {
        if ($request->name != $dormitory->name) {
            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique('dormitories')],
            ]);
        }
        $dormitory->update($request->all());
        Toast::success('Daerah berhasil diubah')->autoDismiss(2);
        // return redirect()->route('dormitory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dormitory $dormitory)
    {
        //
    }
}
