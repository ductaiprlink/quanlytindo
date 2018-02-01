<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Position;

class PositionController extends Controller
{
    // danh sach chuc vu
    public function index()
    {
        $positions = Position::paginate(15);
        $i = 0;
        return view('positions.index', compact('positions', 'i'));
    }

    // lay view them chuc vu
    public function create()
    {
        return view('positions.create');
    }

    // them chuc vu
    public function store(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required'
        ], [
            'position_name.required' => 'Bạn chưa nhập tên chức vụ'
        ]);

        $position_name = $request->position_name;

        $position = new Position();
        $position->position_name = $position_name;
        $position->save();

        return redirect()->route('positions.index')->with('success', 'Thêm chức vụ mới thành công');
    }

    // lay view sua
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('positions.edit',compact('position'));
    }

    // sua chuc vu
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'position_name' => 'required'
        ], [
            'position_name.required' => 'Bạn chưa nhập tên chức vụ'
        ]);

        $position_name = $request->position_name;

        $position = Position::findOrFail($id);
        $position->position_name = $position_name;
        $position->save();

        return redirect()->route('positions.index')->with('success', 'Cập nhật chức vụ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $result = 'Chức vụ ' . $position->position_name . ' đã bị xóa';
        $position->delete();
        return back()->with('success', $result);
    }
}
