<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Achievement;
use App\Employee;

class AchievementController extends Controller
{
    // lay danh sach thanh tich - khuyet diem
    public function index($id)
    {
        $employee = Employee::findOrFail($id);
        $achievements = Achievement::where('employee_id', $id)->get();

        return view('achievements.index', compact('achievements', 'employee', 'id'));
    }

    // lay view them
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        return view('achievements.create', compact('employee', 'id'));
    }

    // them thanh tich
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            "date" => "required",
        ], [
            'date.required' => 'Bạn chưa chọn ngày tháng'
        ]);

        Achievement::create($request->all());
        return redirect()->route('achievements.index', ['id' => $id])->with('success', 'Thêm thành tích (khuyết điểm) thành công');
    }

    // lay view sua
    public function edit($id, $achie_id)
    {
        $employee = Employee::findOrFail($id);
        $achievement = Achievement::findOrFail($achie_id);
        return view('achievements.edit', compact('employee', 'id', 'achievement'));
    }

    // sua thanh tich - khuyet diem
    public function update(Request $request, $id, $achie_id)
    {
        $achievement = Achievement::findOrFail($achie_id);
        $achievement->employee_id = $id;
        $achievement->date = $request->date;
        $achievement->advantage = $request->advantage;
        $achievement->disadvantage = $request->disadvantage;
        $achievement->save();

        return redirect()->route('achievements.index', ['id' => $id])->with('success', 'Sửa thành tích (khuyết điểm) thành công');
    }

    //xoa
    public function destroy($id, $achie_id)
    {
        $achievement = Achievement::findOrFail($achie_id);
        $result = 'Thành tích ' . $achievement->advantage . ' và khuyết điểm '. $achievement->disadvantage. ' đã bị xóa';
        $achievement->delete();
        return back()->with('success', $result);
    }
}
