<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Education;

class EducationController extends Controller
{
    // danh sach trinh do hoc van
    public function index()
    {
        $educations = Education::orderBy('order', 'asc')->paginate(15);
        $i = 0;
        return view('educations.index', compact('educations', 'i'));
    }

    // lay view them hoc van
    public function create()
    {
        return view('educations.create');
    }

    // lưu them hoc van
    public function store(Request $request)
    {
        $this->validate($request, [
            'education_name' => 'required'
        ], [
            'education_name.required' => 'Bạn chưa nhập trình độ học vấn'
        ]);

        $education_name = $request->education_name;

        $getOrder = Education::orderBy('order', 'desc')->select('order')->first();

        $education = new Education();
        $education->education_name = $education_name;
        $education->order = (int)($getOrder->order) + 1;
        $education->save();

        return redirect()->route('educations.index')->with('success', 'Thêm học vấn mới thành công');
    }

    // lay view sua
    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('educations.edit',compact('education'));
    }

    // sua trinh do hoc van
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'education_name' => 'required'
        ], [
            'education_name.required' => 'Bạn chưa nhập trình độ học vấn'
        ]);

        $education_name = $request->education_name;

        $education = Education::findOrFail($id);
        $education->education_name = $education_name;
        $education->save();

        return redirect()->route('educations.index')->with('success', 'Sửa học vấn thành công');
    }

    // xóa
    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $result = 'Học vấn ' . $education->education_name . ' đã bị xóa';
        $education->delete();
        return back()->with('success', $result);
    }
}
