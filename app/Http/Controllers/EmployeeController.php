<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Employee;
use App\Marriage;
use App\Department;
use App\Position;
use App\Education;
use App\Province;
use App\District;
use App\Ward;
use App\Family;
use App\Achievement;
use App\Member;
use Image;
use Excel;
use DB;

class EmployeeController extends Controller
{
    // danh sách tín đồ
    public function index(Request $request)
    {
        $employees = new Employee;

        $queries = [];

        $columns = [
            'gender', 'department_id', 'position_id', 'marriage_id', 'education_id'
        ];

        foreach ($columns as $column) {
            if ($request->has($column)) {
                $employees = $employees->where($column, $request->get($column));
                $queries[$column] = $request->get($column);
            }
        }

        // sort
        if ($request->has('sort')) {
            $employees = $employees->orderBy('name', $request->get('sort'));
            $queries['sort'] = request('sort');
        }

        $count = count($employees->get());
        $employees = $employees->paginate(10)->appends($queries);

        $i = 0;
        $departments = Department::get();
        $positions = Position::get();
        $marriages = Marriage::get();
        $educations = Education::get();
        $provinces = Province::get();
        $careers = Employee::where('career', '<>', '')->select('career')->get();

        return view('employees.index', compact('employees', 'i', 'departments', 'positions', 'careers', 'marriages', 'educations', 'provinces', 'count'));
    }

    // lay view them tin do
    public function create()
    {
        $marriages = Marriage::get();
        $departments = Department::get();
        $positions = Position::get();
        $provinces = Province::get();
        $educations = Education::get();
        $families = Family::get();

        return view('employees.create', compact('marriages', 'departments', 'positions', 'provinces', 'educations', 'families'));
    }

    // them tin do
    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar'                => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // validate cho hình ảnh, |image|mimes:jpeg,png,jpg,gif,svg|max:10240
            'name'                  => 'required',
            'date'                  => 'required',
            'phone'                 => 'required',
            'career'                => 'required',
            'identity_card_number'  => 'required',
            'religion_name'         => 'required',
            'dateofjoining'         => 'required',
            'street'                => 'required',
            'street_tabernacle'     => 'required',
            'introduced_id'         => 'required',
        ],[
            'required'      => 'Bạn chưa nhập :attribute',
            'image'         => 'Bạn vui lòng chọn đúng hình ảnh',
            'mimes'         => 'Vấn đề mimes',
            'max'           => 'vấn đề dung lượng',
        ]);

        // lấy dữ liệu
        $name       = $request->name;
        $date       = $request->date;
        $phone      = $request->phone;
        $career     = $request->career;
        $is_leader  = $request->is_leader;
        $identity_card_number   = $request->identity_card_number;
        $religion_name          = $request->religion_name;
        $dateofjoining          = $request->dateofjoining;
        $dateofleaving          = $request->dateofleaving;
        $introduced             = $request->introduced_id;
        $gender         = $request->gender;
        $marriage       = $request->marriage_id;
        $education      = $request->education_id;
        $department     = $request->department_id;
        $position       = $request->position_id;

        $pro = new Province();
        // địa chỉ thường trú
        $province   = $request->province_id;
        $district   = $request->district_id;
        $ward       = $request->ward_id;
        $street     = $request->street;

        $address    = $pro->address($province, $district, $ward, $street);

        // địa chỉ tạm trú
        $province_tabernacle_id     = $request->province_tabernacle_id;
        $district_tabernacle_id     = $request->district_tabernacle_id;
        $ward_tabernacle_id         = $request->ward_tabernacle_id;
        $street_tabernacle          = $request->street_tabernacle;
        $tabernacle                 = $pro->address($province_tabernacle_id, $district_tabernacle_id, $ward_tabernacle_id, $street_tabernacle);

        $imageName = '';
        // copy hình đại diện vào thư mục
        if(Input::hasFile('avatar')) { // kiem tra co upload file avatar hay khong

            $avatar     = $request->file('avatar'); // lay file avatar
            $imageName  = $identity_card_number.'.'.$avatar->getClientOriginalExtension(); // rename file avatar
            $img        = Image::make($avatar); // khoi tao object Image
            $img->resize(150, 200)->save(public_path('avatar').'/'.$imageName); // resize va save avatar
        }

        $new = new Employee();
        $new->name      = $name;
        $new->image     = $imageName;
        $new->date      = $date;
        $new->gender    = $gender;
        $new->phone     = $phone;
        $new->is_leader         = $is_leader;
        $new->department_id     = $department;
        $new->position_id       = $position;
        $new->dateofjoining     = $dateofjoining;
        $new->dateofleaving     = $dateofleaving;
        $new->identity_card_number  = $identity_card_number;
        $new->religion_name     = $religion_name;
        $new->marriage_id       = $marriage;
        $new->education_id      = $education;
        $new->career            = $career;
        $new->introduced_id     = $introduced;
        $new->province_id       = $province;
        $new->district_id       = $district;
        $new->ward_id   = $ward;
        $new->street    = $street;
        $new->address   = $address;
        $new->province_tabernacle_id    = $province_tabernacle_id;
        $new->district_tabernacle_id    = $district_tabernacle_id;
        $new->ward_tabernacle_id        = $ward_tabernacle_id;
        $new->street_tabernacle         = $street_tabernacle;
        $new->tabernacle                = $tabernacle;
        $new->save();

        return redirect()->route('employees.index')->with('success', 'Thêm thành viên mới thành công');
    }

    // xem tin do
    public function show($id)
    {
        $employee       = Employee::findOrFail($id);

        // nếu csdl đã có người dẫn dắt thì mới truyền dữ liệu qua bên kia
        if ($employee->introduced_id != null)
        {
            $introduced     = Employee::findOrFail($employee->introduced_id);
        }
        else $introduced = '';

        $achievements = Achievement::where('employee_id', $id)->get();

        $members = Member::where('member1_id', $id)->get();

        return view('employees.show', compact('employee', 'introduced', 'achievements', 'members'));
    }

    // lay view sua tin do
    public function edit($id)
    {
        $employee       = Employee::findOrFail($id);

        if ($employee->introduced_id != 0 || $employee->introduced_id != '') {
            $introduced     = Employee::findOrFail($employee->introduced_id);
        }

        $marriages      = Marriage::get();
        $departments    = Department::get();
        $positions      = Position::get();
        $educations     = Education::orderBy('order', 'asc')->get();

        // địa chỉ thường trú
        $provinces      = Province::get();
        $districts      = District::where('province_id', $employee->province_id)->get(); // lay bang province_id
        $wards          = Ward::where('district_id', $employee->district_id)->get(); // lay bang district_id

        // địa chỉ tạm trú
        $districts_tabernacles = District::where('province_id', $employee->province_tabernacle_id)->get(); // lay bang province_id
        $wards_tabernacles = Ward::where('district_id', $employee->district_tabernacle_id)->get(); // lay bang district_id

        return view('employees.edit', compact( 'employee', 'introduced', 'marriages', 'departments', 'positions', 'provinces', 'educations', 'districts', 'wards', 'districts_tabernacles', 'wards_tabernacles', 'families'));
    }

    // sua tin do
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $pro = new Province();

        $update                         = Employee::find($id);
        $update->name                   = $request->name;
        $update->date                   = $request->date;
        $update->gender                 = $request->gender;
        $update->phone                  = $request->phone;
        $update->is_leader              = $request->is_leader;
        $update->department_id          = $request->department;
        $update->position_id            = $request->position_id;
        $update->dateofjoining          = $request->dateofjoining;
        $update->dateofleaving          = $request->dateofleaving;
        $update->identity_card_number   = $request->identity_card_number;
        $update->religion_name          = $request->religion_name;
        $update->career                 = $request->career;
        $update->marriage_id            = $request->marriage;
        $update->education_id           = $request->education;
        $update->province_id            = $request->province;
        $update->district_id            = $request->district;
        $update->ward_id                = $request->ward;
        $update->street                 = $request->street;
        $address                        = $pro->address($request->province, $request->district, $request->ward, $request->street); // dia chi thuong tru
        $update->address                = $address; // cái này dùng hàm address
        $update->province_tabernacle_id = $request->province_tamtru;
        $update->district_tabernacle_id = $request->district_tamtru;
        $update->ward_tabernacle_id     = $request->ward_tamtru;
        $update->street_tabernacle      = $request->street_tamtru;
        $tabernacle                     = $pro->address($request->province_tamtru, $request->district_tamtru, $request->ward_tamtru, $request->street_tamtru); // dia chi tam tru
        $update->tabernacle             = $tabernacle; // cái này dùng hàm address

        if (Input::hasFile('avatar'))
        {
            $file       = $request->file('avatar');
            $imageName  = $request->identity_card_number.'.'.$file->getClientOriginalExtension();
            $img = Image::make($file);
            $img->resize(150, 200)->save(public_path('avatar').'/'.$imageName);
//            $file->move(base_path('resources/assets/avatar'), $imageName);
            $update->image = $imageName;
        }

//        if ($request->introduced != '')
//        {
//            $update->introduced_id = $request->introduced;
//        }

        if ($request->introduced_id == null)
        {
            $update->introduced_id = 0;

        }else{

            $update->introduced_id = $request->introduced_id;
        }

        $update->save();

        return back()->with('success', 'Sửa thông tin thành viên thành công');
    }

    // xoa tin do
    public function destroy($id)
    {
        $delete = Employee::findOrFail($id);
        $result = $delete->name . ' đã bị xóa';
        $delete->delete();

        return back()->with('success', $result);
    }

    // lay danh sach nguoi gioi thieu trong sua
    public function introduced($id)
    {
        $employees = Employee::whereNotIn('id', [$id])->get();
        return response()->json($employees);
    }

    // lay danh sach nguoi gioi thieu trong them
    public function createintroduced()
    {
        $employees = Employee::get();
        return response()->json($employees);
    }

    // lay danh sach tinh
    public function getDistrict($pro_id)
    {
        $districts = District::where('province_id', $pro_id)->get();

        echo '<option value="0">-- Chọn quận/huyện --</option>';
        foreach ($districts as $district)
        {
            echo '<option value="' .$district->id. '">' .$district->name. '</option>';
        }
    }

    // lay danh sach quan huyen
    public function getWard($pro_id, $dis_id)
    {
        $wards = Ward::where('district_id', $dis_id)->get();

        echo '<option value="0">-- Chọn xã/phường --</option>';
        foreach ($wards as $ward)
        {
            echo '<option value="' .$ward->id. '">' .$ward->name. '</option>';
        }
    }

    // thiet ke mau file excel
    public function downloadExcelSample()
    {
        return Excel::create('ExcelSample', function($excel){
            $excel->sheet('tindo', function($sheet){

                // Tạo tiêu đề
                $sheet->setCellValue('A1', 'name');
                $sheet->setCellValue('B1', 'gender');
                $sheet->setCellValue('C1', 'marriage');
                $sheet->setCellValue('D1', 'birthday');
                $sheet->setCellValue('E1', 'ward');
                $sheet->setCellValue('F1', 'district');
                $sheet->setCellValue('G1', 'province');
                $sheet->setCellValue('H1', 'identity_card_number');
                $sheet->setCellValue('I1', 'education');
                $sheet->setCellValue('J1', 'career');
                $sheet->setCellValue('K1', 'phone');

                // Tạo comment
                $sheet->getComment('A1')->getText()->createTextRun('Họ tên');
                $sheet->getComment('B1')->getText()->createTextRun('Giới tính');
                $sheet->getComment('C1')->getText()->createTextRun('Hôn nhân');
                $sheet->getComment('D1')->getText()->createTextRun('Năm sinh');
                $sheet->getComment('E1')->getText()->createTextRun('Phường/Xã');
                $sheet->getComment('F1')->getText()->createTextRun('Quận/Huyện');
                $sheet->getComment('G1')->getText()->createTextRun('Tỉnh/Thành Phố');
                $sheet->getComment('H1')->getText()->createTextRun('CMND');
                $sheet->getComment('I1')->getText()->createTextRun('Trình độ học vấn');
                $sheet->getComment('J1')->getText()->createTextRun('Nghề nghiệp');
                $sheet->getComment('K1')->getText()->createTextRun('Số điện thoại');
            });
        })->export('xlsx');
    }

    // download mau file excel
    public function importEmployees(Request $request)
    {
        $file = $request->file('list');
        $path = $file->getRealPath();
        $data = Excel::load($path, function ($reader){})->get();
        $errors = array();

        if (!empty($data) && $data->count())
        {
            // 1. lấy dữ liệu text từ file excel,
            // 2. where với DB, lấy ra id cần dùng,
            // 3. tạo 1 mảng mới có dữ liệu chuẩn xác với DB
            foreach ($data as $key => $dt)
            {
                // lay ten
                $name = $dt->name;

                // lay gioi tinh
                ($dt->gender == 'Nam') ? $gender = 1 : $gender = 0;

                // hon nhan
                $marriage = Marriage::where('marriage_name', 'like', '%'.trim($dt->marriage,' ').'%')->first();

                // gap loi bo qua vong lap
                if($marriage == null)
                {
                    array_push($errors, $name);
                    continue;
                }
                $marriage_id = $marriage->id;

                // ngay sinh
                $birthday   = $dt->birthday;
                $date       = $birthday.'-01-01';

                // lay tinh, thanh pho
                $province       = Province::where('name', 'like', '%'.trim($dt->province, ' ').'%')->first();

                // gap loi bo qua vong lap
                if($province == null)
                {
                    array_push($errors, $name);
                    continue;
                }
                $province_id    = $province->id;

                // lay quan, huyen
                $district       = District::where('name', 'like', '%'.trim($dt->district, ' ').'%')->where('province_id', $province_id)->first();

                // gap loi bo qua vong lap
                if($district == null)
                {
                    array_push($errors, $name);
                    continue;
                }

                $district_id    = $district->id;

                // lay xa, phuong
                $ward       = Ward::where('name', 'like', '%'.trim($dt->ward).'%')->where('district_id', $district_id)->first();

                // gap loi bo qua vong lap
                if($ward == null)
                {
                    array_push($errors, $name);
                    continue;
                }

                $ward_id    = $ward->id;

                // lay CMND
                (count($dt->identity_card_number) > 0) ? $identity_card_number = $dt->identity_card_number : $identity_card_number = ' ';

                // lay trinh do hoc van
                $education = Education::where('education_name', $dt->education)->first();

                // gap loi bo qua vong lap
                if($education == null)
                {
                    array_push($errors, $name);
                    continue;
                }

                $education_id = $education->id;

                // lay nghe nghiep
                (count($dt->career) > 0) ? $career = $dt->career : $career = ' ';

                // lay so dien thoai
                (count($dt->phone) > 0) ? $phone = $dt->phone : $phone = ' ';

                $imports[] = [
                    'name' => $name,
                    'gender' => $gender,
                    'marriage_id' => $marriage_id,
                    'date' => $date,
                    'ward_id' => $ward_id,
                    'district_id' => $district_id,
                    'province_id' => $province_id,
                    'identity_card_number' => $identity_card_number,
                    'education_id' => $education_id,
                    'career' => $career,
                    'phone' => $phone,
                ];
            }

            // 4. thêm dữ liệu chuẩn xác vào db
            if(!empty($imports))
            {

                DB::table('employees')->insert($imports);
                $total = count($imports);
            }
        }

        return back()->with('success', 'Import tín đồ thành công')->with('total', $total)->with('errors', $errors);
    }

    //search - laravel scout, algolia
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $employees = Employee::search($request->keyword)->paginate(10);
        return view('employees.result', compact('employees', 'keyword'));
    }

    //search Advanced bang POST method
    public function searchAdvanced(Request $request)
    {
        // Lấy dữ liệu
        $gender                 = $request->gender;
        $phone                  = $request->phone;
        $family_id              = $request->family_id;
        $department_id          = $request->department_id;
        $position_id            = $request->position_id;
        $identity_card_number   = $request->identity_card_number;
        $career                 = $request->career;
        $marriage_id            = $request->marriage_id;
        $education_id           = $request->education_id;
        $province_id            = $request->province_id;
        $introduced_id          = $request->introduced_id;

        // danh sách các yêu cầu
        $req = array();

        // Tìm kiem
        $result = Employee::where('showhide', 1);

        // Gới tính
        if ($gender != '')
        {
            $result = $result->where('gender', $gender);
//            array_push($req, array('tieude' => 'Giới tính', 'giatri' => $gender));
            if ($gender == 1)
            {
                array_push($req, 'Giới tính: Nam');
            }
            else{
                array_push($req, 'Giới tính: Nữ');
            }

        }

        // so dien thoai
        if ($phone != '')
        {
            $result = $result->where('phone', $phone);
//            array_push($req, array('tieude' => 'Số điện thoại', 'giatri' => $phone));
            array_push($req, 'Số điện thoại: '.$phone);
        }

        // thuộc gia đình
        if ($family_id != '')
        {
            $result = $result->where('family_id', $family_id);
            $fml = Family::findOrFail($family_id);
//            array_push($req, array('tieude' => 'Gia đình', 'giatri' => $fml->family_name));
            array_push($req, $fml->family_name);
        }

        // trụ sở
        if ($department_id != '')
        {
            $result = $result->where('department_id', $department_id);
            $dept = Department::findOrFail($department_id);
//            array_push($req, array('tieude' => 'Trụ sở', 'giatri' => $dept->department));
            array_push($req,'Trụ sở: '.$dept->department_name);
        }

        // Chức vụ
        if ($position_id != '')
        {
            $result = $result->where('position_id', $position_id);
            $pos = Position::findOrFail($position_id);
//            array_push($req, array('tieude' => 'Chức vụ', 'giatri' => $desg->designation));
            array_push($req, 'Chức vụ: '.$pos->position_name);
        }

        // CMND
        if ($identity_card_number != '')
        {
            $result = $result->where('identity_card_number', $identity_card_number);
//            array_push($req, array('tieude' => 'identity_card_number', 'giatri' => $identity_card_number));
            array_push($req, 'CMND: '.$identity_card_number);
        }

        // Nghề nghiệp
        if ($career != '')
        {
            $result = $result->where('career', $career);
//            array_push($req, array('tieude' => 'Nghề nghiệp', 'giatri' => $career));
            array_push($req, 'Nghề nghiệp: '.$career);
        }

        // Hôn nhân
        if ($marriage_id != '')
        {
            $result = $result->where('marriage_id', $marriage_id);
            $marriage = Marriage::findOrFail($marriage_id);
//            array_push($req, array('tieude' => 'Hôn nhân', 'giatri' => $marriage->marriage_name));
            array_push($req, 'Hôn nhân: '.$marriage->marriage_name);
        }

        // Trình độ học vấn
        if ($education_id != '')
        {
            $result = $result->where('education_id', $education_id);
            $education = Education::findOrFail($education_id);
//            array_push($req, array('tieude' => 'Học vấn', 'giatri' => $education->education));
            array_push($req, 'Học vấn: '.$education->education_name);
        }

        // Tỉnh thành
        if ($province_id != '')
        {
            $result = $result->where('province_id', $province_id);
            $province = Province::findOrFail($province_id);
//            array_push($req, array('tieude' => 'Tỉnh thành', 'giatri' => $province->name));
            array_push($req, 'Tỉnh thành: '.$province->name);
        }

        // Người giới thiệu
        if ($introduced_id != '')
        {
            $result = $result->where('introduced_id', $introduced_id);
            $introduced = Employee::findOrFail($introduced_id);
//            array_push($req, array('tieude' => 'Người giới thiệu', 'giatri' => $introduced->name));
            array_push($req, 'Người giới thiệu: '.$introduced->name);
        }

//        dd($req);
//        $result = $result->get();
        $result = $result->paginate(15);
        $counter = $result->count();

        return back()->with('result', $result)->with('counter', $counter)->with('req', $req);
    }

    // TIM KIEM NANG CAO (GET METHOD)
    public function filter()
    {
        // Lấy dữ liệu
        $demo = \Request::get('gender');
    }
}
