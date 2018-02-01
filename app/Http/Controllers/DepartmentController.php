<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Employee;
use App\Province;
use App\District;
use App\Ward;

class DepartmentController extends Controller
{
    // Danh sách trụ sở
    public function index()
    {
        $departments = Department::paginate(10);
        $i = 0;
        return view('departments.index', compact('departments', 'i'));
    }

    // lay view them
    public function create()
    {
        $provinces = Province::get();
        $employees = Employee::get();
        return view('departments.create',compact( 'provinces', 'employees'));
    }

    // lay nguoi dai dien
    public function introduced()
    {
        $employees = Employee::get();
        return response()->json($employees);
    }

    // get district
    public function getDistrict($pro_id)
    {
        $districts = District::where('province_id', $pro_id)->get();

        echo '<option value="0">-- Chọn quận/huyện --</option>';
        foreach ($districts as $district)
        {
            echo '<option value="' .$district->id. '">' .$district->name. '</option>';
        }
    }

    // get ward
    public function getWard($pro_id, $dis_id)
    {
        $wards = Ward::where('district_id', $dis_id)->get();

        echo '<option value="0">-- Chọn xã/phường --</option>';
        foreach ($wards as $ward)
        {
            echo '<option value="' .$ward->id. '">' .$ward->name. '</option>';
        }
    }

    // them moi tru so
    public function store(Request $request){

        $this->validate($request,[
            "department_name" => "required",
            "street" => "required",
        ], [
            'department_name.required' => 'Bạn chưa điền tên trụ sở',
            'street.required' => 'Bạn chưa điền tên đường'
        ]);

        $department_name    = $request->department_name;
        $province_id        = $request->province;
        $district_id        = $request->district;
        $ward_id            = $request->ward;
        $street             = $request->street;
        $leader_id          = $request->leader_id;

        $tinh   = Province::find($province_id);
        $huyen  = District::find($district_id);
        $xa     = Ward::find($ward_id);

        $address = $street.', '.$xa->name.', '.$huyen->name.', '.$tinh->name;

        $department = new Department();
        $department->department_name = $department_name;
        $department->address = $address;
        $department->street = $street;
        $department->province_id = $province_id;
        $department->district_id = $district_id;
        $department->ward_id = $ward_id;
        $department->leader_id = $leader_id;
        $department->showhide = 1;
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Thêm trụ sở mới thành công');
    }

    // lay view sua
    public function edit($id){

//        $presents   = Department::findOrFail($id); // nguoi dai dien
        $provinces  = Province::get();
        $districts  = District::get();
        $wards      = Ward::get();
        $department = Department::findOrFail($id);

        return view('departments.edit',compact('department', 'provinces', 'districts', 'wards'));
    }

    // tien hanh sua tru so
    public function update(Request $request, $id){

        $this->validate($request,[
            "department_name" => "required",
        ]);

        $department_name = $request->department_name;
        $province_id    = $request->province;
        $district_id    = $request->district;
        $ward_id        = $request->ward;
        $street         = $request->street;
        $leader         = $request->leader_id;
//        $showhide       = $request->showhide;

        $tinh   = Province::find($province_id);
        $huyen  = District::find($district_id);
        $xa     = Ward::find($ward_id);

        $address = $street.', '.$xa->name.', '.$huyen->name.', '.$tinh->name;

        $department = Department::findOrFail($id);
        $department->department_name = $department_name;
        $department->address = $address;
        $department->street = $street;
        $department->province_id = $province_id;
        $department->district_id = $district_id;
        $department->ward_id = $ward_id;
        $department->leader_id = $leader;
//        $department->showhide = $showhide;
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Cập nhật trụ sở thành công');
    }

    // xoa
    public function destroy($id){

        $department = Department::findOrFail($id);
        $result = 'Trụ sở ' . $department->department_name . ' đã bị xóa';
        $department->delete();
        return back()->with('success', $result);
    }
}
