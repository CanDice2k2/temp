<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use App\Models\Log;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private $departments;

    public function __construct()
    {
        $this->middleware('auth');

        $this->departments = resolve(Department::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->departments->paginate();
        return view('pages.departments-data', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.departments-data_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        Log::create([
            'description' => auth()->user()->employee->name . " đã tạo một phòng ban có tên '" . $request->input('name') . "'"
        ]);

        return redirect()->route('departments-data')->with('status', 'Tạo phòng ban thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('pages.departments-data_show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('pages.departments-data_edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepartmentRequest $request, Department $department)
    {
        Department::where('id', $department->id)->update($request->validated());

        Log::create([
            'description' => auth()->user()->employee->name . " đã cập nhật phòng ban có tên '" . $department->name . "'"
        ]);

        return redirect()->route('departments-data')->with('status', 'Cập nhật phòng ban thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        // Kiểm tra nếu có nhân viên thuộc phòng ban này
        if ($department->employees()->count() > 0) {
            return redirect()->route('departments-data')
                ->with('error', 'Không thể xóa phòng ban này vì vẫn có nhân viên thuộc phòng ban.');
        }

        Department::where('id', $department->id)->delete();

        Log::create([
            'description' => auth()->user()->employee->name . " đã xóa phòng ban có tên '" . $department->name . "'"
        ]);

        return redirect()->route('departments-data')->with('status', 'Xóa phòng ban thành công.');
    }

    public function print() {
        $departments = Department::all();
        return view('pages.departments-data_print', compact('departments'));
    }
}
