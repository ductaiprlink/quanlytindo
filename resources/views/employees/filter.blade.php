{{--GENDER--}}
<div class="col-sm-2">
    {{--Bộ lọc:--}}
    {{--@for ($i = 0; $i < 2; $i++)--}}
        {{--<a href="{{ route('employees.index', [--}}
                                {{--'gender'        => $i,--}}
                                {{--'marriage_id'   => request('marriage_id'),--}}
                                {{--'department_id' => request('department_id'),--}}
                                {{--'position_id'   => request('position_id'),--}}
                                {{--'education_id'  => request('education_id'),--}}
                                {{--'sort'          => request('sort')]) }}">--}}
            {{--@if (request('gender') == $i)--}}
                {{--<strong>@if ($i == 0) Nữ @else Nam @endif</strong>--}}
            {{--@else--}}
                {{--@if ($i == 0) Nữ @else Nam @endif--}}
            {{--@endif--}}
            {{--</a> |--}}
    {{--@endfor--}}
    {{--<a href="{{ route('employees.index', [--}}
                                {{--'gender'        => 1,--}}
                                {{--'marriage_id'   => request('marriage_id'),--}}
                                {{--'department_id' => request('department_id'),--}}
                                {{--'position_id'   => request('position_id'),--}}
                                {{--'education_id'  => request('education_id'),--}}
                                {{--'sort'          => request('sort')]) }}">Nam</a> |--}}

    {{--<a href="{{ route('employees.index', [--}}
                                {{--'gender'        => 0,--}}
                                {{--'marriage_id'   => request('marriage_id'),--}}
                                {{--'department_id' => request('department_id'),--}}
                                {{--'position_id'   => request('position_id'),--}}
                                {{--'education_id'  => request('education_id'),--}}
                                {{--'sort'          => request('sort')]) }}">Nữ</a> |--}}

    {{--<a href="{{ route('employees.index') }}" class="btn btn-flat btn-primary btn-sm">Reset</a>--}}

    <select class="form-control select" name="gender" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option disabled="" selected="true">---  Giới tính ---</option>


        @for ($i = 1; $i <= 2; $i++)
            <option value="{{ route('employees.index', [
                                'gender'        => $i,
                                'marriage_id'   => request('marriage_id'),
                                'department_id' => request('department_id'),
                                'position_id'   => request('position_id'),
                                'education_id'  => request('education_id'),
                                'sort'          => request('sort')]) }}"
                    @if ((request('gender') == $i))
                        selected
                    @endif
            >
                @if ($i == 1) Nữ @else Nam @endif
            </option>
        @endfor
        <option value="{{ route('employees.index') }}">Reset</option>
    </select>
</div>

{{--MARRIAGE--}}
<div class="col-sm-2">
    <select class="form-control select" name="marriage_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option disabled="" selected="">---  Hôn nhân ---</option>

        @foreach($marriages as $mar)
            <option value="{{ route('employees.index', [
                                        'gender'        => request('gender'),
                                        'marriage_id'   => $mar->id,
                                        'department_id' => request('department_id'),
                                        'position_id'   => request('position_id'),
                                        'education_id'  => request('education_id'),
                                        'sort'          => request('sort')]) }}"
            @if (request('marriage_id') == $mar->id)
                selected
            @endif
            >{{ $mar->marriage_name }}</option>
        @endforeach
    </select>
</div>

{{--DEPARTMENT--}}
<div class="col-sm-2">
    <select class="form-control select" name="department_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option disabled="" selected="">---  Trụ sở ---</option>

        @foreach($departments as $dept)
            <option value="{{ route('employees.index', [
                                        'gender'        => request('gender'),
                                        'marriage_id'   => request('marriage_id'),
                                        'department_id' => $dept->id,
                                        'position_id'   => request('position_id'),
                                        'education_id'  => request('education_id'),
                                        'sort'          => request('sort')]) }}"
            @if (request('department_id') == $dept->id)
                selected
            @endif
            >{{ $dept->department_name }}</option>
        @endforeach
    </select>
</div>

{{--POSITION--}}
<div class="col-sm-2">
    <select class="form-control select" name="position_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option disabled="" selected="">---  Chức vụ ---</option>

        @foreach($positions as $pos)
            <option value="{{ route('employees.index', [
                                        'gender'        => request('gender'),
                                        'marriage_id'   => request('marriage_id'),
                                        'department_id' => request('department_id'),
                                        'position_id'   => $pos->id,
                                        'education_id'  => request('education_id'),
                                        'sort'          => request('sort')]) }}"
            @if (request('position_id') == $pos->id)
                selected
            @endif
            >{{ $pos->position_name }}</option>
        @endforeach
    </select>
</div>

{{--EDUCATION--}}
<div class="col-sm-2">
    <select class="form-control select" name="education_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option disabled="" selected="">---  Học vấn ---</option>

        @foreach($educations as $edu)
            <option value="{{ route('employees.index', [
                                        'gender'        => request('gender'),
                                        'marriage_id'   => request('marriage_id'),
                                        'department_id' => request('department_id'),
                                        'position_id'   => request('position_id'),
                                        'education_id'  => $edu->id,
                                        'sort'          => request('sort')]) }}"
            @if (request('education_id') == $edu->id)
                selected
            @endif
            >{{ $edu->education_name }}</option>
        @endforeach
    </select>
</div>

{{-- SORT --}}
<div class="col-sm-2">
    {{--Sort:--}}
    {{--<a href="{{ route('employees.index', [--}}
                                        {{--'gender'        => request('gender'),--}}
                                        {{--'marriage_id'   => request('marriage_id'),--}}
                                        {{--'department_id' => request('department_id'),--}}
                                        {{--'position_id'   => request('position_id'),--}}
                                        {{--'education_id'  => request('education_id'),--}}
                                        {{--'sort'          => 'asc']) }}">ASC</a> |--}}

    {{--<a href="{{ route('employees.index', [--}}
                                        {{--'gender'        => request('gender'),--}}
                                        {{--'marriage_id'   => request('marriage_id'),--}}
                                        {{--'department_id' => request('department_id'),--}}
                                        {{--'position_id'   => request('position_id'),--}}
                                        {{--'education_id'  => request('education_id'),--}}
                                        {{--'sort'          => 'desc']) }}">DESC</a>--}}

    <select class="form-control select" name="education_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option disabled="" selected="">---  Sắp xếp ---</option>


            <option value="{{ route('employees.index', [
                                        'gender'        => request('gender'),
                                        'marriage_id'   => request('marriage_id'),
                                        'department_id' => request('department_id'),
                                        'position_id'   => request('position_id'),
                                        'education_id'  => request('education_id'),
                                        'sort'          => 'asc']) }}"
                    @if (request('sort') == 'asc')
                        selected
                    @endif
            >Tăng dần</option>

            <option value="{{ route('employees.index', [
                                        'gender'        => request('gender'),
                                        'marriage_id'   => request('marriage_id'),
                                        'department_id' => request('department_id'),
                                        'position_id'   => request('position_id'),
                                        'education_id'  => request('education_id'),
                                        'sort'          => 'desc']) }}"
                @if (request('sort') == 'desc')
                    selected
                @endif
            >Giảm dần</option>

    </select>
</div>