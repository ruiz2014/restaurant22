<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room\Room;
use App\Models\Room\Table;
use App\Http\Requests\RoomRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index(Request $request){
        
        $rooms = Room::paginate();

        return view('room.index', compact('rooms'))
            ->with('i', ($request->input('page', 1) - 1) * $rooms->perPage());
    }

    public function create(): View
    {
        $room = new Room();

        return view('room.create', compact('room'));
    }

    public function store(RoomRequest $request): RedirectResponse
    {
        // dd($request);
        $room = Room::create($request->validated() + ['user_id' => 1]); //auth()->id()

        for($i = 0; $i < $request->number_tables; $i++){
            Table::create(['identifier' =>$i+1, 'room_id'=>$room->id, 'place_id'=>1, 'observation'=>'El restaurant']);
        }

        return Redirect::route('room.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id): View
    {
        $room = Room::findOrFail($id);
        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Room $room): RedirectResponse
    {
        $room->update($request->validated());

        return Redirect::route('room.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Room::findOrFail($id)->delete();

        return Redirect::route('room.index')
            ->with('success', 'Category deleted successfully');
    }
}
