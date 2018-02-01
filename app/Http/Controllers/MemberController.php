<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Employee;
use App\Relationship;

class MemberController extends Controller
{
    // lay danh sach thanh vien
    public function index($id)
    {
        $members    = Member::where('member1_id', $id)->get();
        $employee   = Employee::findOrFail($id);

        return view('members.index', compact('members', 'employee', 'id'));
    }

    // lay view them
    public function create($id)
    {
        $employee  = Employee::findOrFail($id);
        $relations = Relationship::get();
        return view('members.create', compact('id', 'employee', 'relations'));
    }

    // danh sach thanh vien 2
    public function member($id)
    {
        $employees = Employee::whereNotIn('id', [$id])->get();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'member2' => 'required'
        ], [
            'required' => ':attribute chưa nhập'
        ]);

        $new = new Member();
        $new->member1_id    = $request->member1_id;
        $new->m1_m2_type    = $request->m1_m2_type;
        $new->member2_id    = $request->member2_id;
        $new->save();

        return redirect()->route('members.index', ['id'=>$id])->with('success', 'Một thành viên đã được thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // lay view sua
    public function edit($id, $member_id)
    {
        $employee   = Employee::findOrFail($id);
        $relations  = Relationship::get();
        $member     = Member::findOrFail($member_id);

        return view('members.edit', compact('employee', 'relations', 'member', 'id'));
    }

    // sua thanh vien
    public function update(Request $request, $id, $member_id)
    {
        $update     = Member::findOrFail($member_id);
        $update->m1_m2_type = $request->m1_m2_type;

        // nếu có thay đổi người thì cập nhật người mới vào
        if ($request->member2_id != '')
        {
            $update->member2_id = $request->member2_id;
        }

        $update->save();

        return redirect()->route('members.index', ['id' => $id])->with('success', 'Sửa thành viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $member_id)
    {
        $delete = Member::findOrFail($member_id);
        $result = 'Đã xóa mối liên hệ thành công';
        $delete->delete();

        return back()->with('success', $result);
    }
}
