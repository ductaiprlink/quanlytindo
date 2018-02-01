<?php

namespace App\Http\Controllers;

use App\Marriage;
use Illuminate\Http\Request;

class MarriageController extends Controller
{
    // danh sach trinh trang hon nhan
    public function index()
    {
        $marriages = Marriage::paginate(15);
        $i = 0;
        return view('marriages.index', compact('marriages', 'i'));
    }

    // lay view them
    public function create()
    {
        return view('marriages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'marriage_name' => 'required'
        ], [
            'marriage_name.required' => 'Bạn chưa nhập tình trạng hôn nhân'
        ]);

        $marriage_name = $request->marriage_name;

        $marriage = new Marriage();
        $marriage->marriage_name = $marriage_name;
        $marriage->save();

        return redirect()->route('marriages.index')->with('success', 'Thêm tình trạng hôn nhân mới thành công');
    }

    // lay view sua
    public function edit($id)
    {
        $marriage = Marriage::findOrFail($id);
        return view('marriages.edit',compact('marriage'));
    }

    // sua tinh trang hon nhan
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'marriage_name' => 'required'
        ], [
            'marriage_name.required' => 'Bạn chưa nhập tình trạng hôn nhân'
        ]);

        $marriage_name = $request->marriage_name;

        $marriage = Marriage::findOrFail($id);
        $marriage->marriage_name = $marriage_name;
        $marriage->save();

        return redirect()->route('marriages.index')->with('success', 'Sửa tình trạng hôn nhân thành công');
    }

    // xóa
    public function destroy($id)
    {
        $marriage = Marriage::findOrFail($id);
        $result = 'Hôn nhân ' . $marriage->marriage_name . ' đã bị xóa';
        $marriage->delete();
        return back()->with('success', $result);
    }
}
