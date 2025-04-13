<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\AttendanceTime;
use App\Models\Employee;
use App\Models\RecruitmentCandidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $announcements;
    private $employees;
    private $recruitmentCandidates;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->announcements = resolve(Announcement::class);
        $this->employees = resolve(Employee::class);
        $this->recruitmentCandidates = resolve(RecruitmentCandidate::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $announcements = $this->announcements->paginate();
        $employeesCount = $this->employees->getCount();
        $recruitmentCandidatesCount = $this->recruitmentCandidates->getCount();
        $endingEmployees = $this->employees->getEndingContractEmployees();

        $attendanceTimesId = AttendanceTime::whereIn("name", ["IN", "OUT"])
                                ->get()
                                ->map(function($item) {
                                    return $item->id;
                                });

        $checkForAttendance = Attendance::whereBetween('created_at', [Carbon::today('Asia/Jakarta'), Carbon::tomorrow('Asia/Jakarta')])
                                ->where('employee_id', auth()->user()->employee->id)
                                ->whereIn('attendance_time_id', $attendanceTimesId)
                                ->exists();

        // Lấy thông kê nhân viên theo phòng ban và giới tính
        $departmentGenderStats = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('employee_details', 'employees.id', '=', 'employee_details.employee_id')
            ->select(
                'departments.name as department',
                DB::raw('SUM(CASE WHEN employee_details.gender = "M" THEN 1 ELSE 0 END) as male'),
                DB::raw('SUM(CASE WHEN employee_details.gender = "F" THEN 1 ELSE 0 END) as female')
            )
            ->groupBy('departments.name')
            ->get();
        // dd($departmentGenderStats);
        return view('pages.dashboard', compact(
            'announcements',
            'employeesCount',
            'recruitmentCandidatesCount',
            'endingEmployees',
            'checkForAttendance',
            'departmentGenderStats'
        ));
    }
}
