<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\EmployeeLeave;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VietnameseEmployeeSeeder extends Seeder
{
    /**
     * Tạo danh sách nhân viên với tên tiếng Việt.
     *
     * @return void
     */
    public function run()
    {

        $lastNames = [
            'Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng',
            'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý', 'Đào', 'Đinh', 'Mai', 'Trịnh'
        ];


        $middleNames = [
            'Văn', 'Thị', 'Hữu', 'Đức', 'Quang', 'Minh', 'Hoài', 'Thanh', 'Ngọc', 'Anh',
            'Tuấn', 'Xuân', 'Hồng', 'Đình', 'Thành', 'Kim', 'Như', 'Thu', 'Hoàng', 'Quốc'
        ];


        $firstNames = [
            'Hùng', 'Anh', 'Linh', 'Hà', 'Minh', 'Tuấn', 'Hương', 'Nam', 'Dũng', 'Thảo',
            'Phương', 'Tú', 'Huy', 'Hải', 'Lan', 'Hoa', 'Thanh', 'Hiếu', 'Tùng', 'Nga',
            'Dung', 'Quân', 'Yến', 'Trung', 'Quỳnh', 'Cường', 'Mai', 'Sơn', 'Thùy', 'Tâm'
        ];


        $departments = Department::all();
        $positions = Position::all();

        if ($departments->isEmpty()) {
            // Tạo một số phòng ban nếu chưa có
            $departmentNames = [
                'Nhân sự', 'Kế toán', 'Kinh doanh', 'Kỹ thuật',
                'Hành chính', 'Marketing', 'CNTT', 'Chăm sóc khách hàng'
            ];

            foreach ($departmentNames as $deptName) {
                Department::factory()->create(['name' => $deptName]);
            }
            $departments = Department::all();
        }

        if ($positions->isEmpty()) {

            $positionNames = [
                'Giám đốc', 'Trưởng phòng', 'Phó phòng', 'Nhân viên',
                'Trưởng nhóm', 'Thực tập sinh', 'Chuyên viên'
            ];

            foreach ($positionNames as $posName) {
                Position::factory()->create(['name' => $posName]);
            }
            $positions = Position::all();
        }

        // Tạo 30 nhân viên
        for ($i = 0; $i < 50; $i++) {
            // Tạo tên tiếng Việt
            $gender = rand(0, 1) ? 'M' : 'F';

            // Chọn tên phù hợp với giới tính
            $firstName = $firstNames[array_rand($firstNames)];
            $middleName = $middleNames[array_rand($middleNames)];
            if ($gender == 'F' && !in_array($middleName, ['Thị', 'Hoài', 'Ngọc', 'Anh', 'Như', 'Thu', 'Kim', 'Hồng'])) {
                $middleName = 'Thị'; // Đảm bảo phụ nữ thường có tên đệm "Thị"
            }

            $lastName = $lastNames[array_rand($lastNames)];
            $fullName = $lastName . ' ' . $middleName . ' ' . $firstName;

            // Tạo email từ tên
            $normalizedName = Str::ascii($firstName . $middleName . substr($lastName, 0, 1));
            $email = strtolower($normalizedName) . rand(1, 999) . '@example.com';

            // Tạo user
            $user = new User();
            $user->name = $fullName;
            $user->email = $email;
            $user->role_id = 2; // Vai trò nhân viên
            $user->password = Hash::make('password');
            $user->save();

            // Chọn phòng ban và vị trí ngẫu nhiên
            $department = $departments->random();
            $position = $positions->random();

            // Tạo nhân viên
            $startDate = Carbon::now()->subMonths(rand(1, 36));
            $endDate = Carbon::now()->addYears(rand(1, 5));

            $employee = new Employee();
            $employee->user_id = $user->id;
            $employee->department_id = $department->id;
            $employee->position_id = $position->id;
            $employee->name = $fullName;
            $employee->start_of_contract = $startDate;
            $employee->end_of_contract = $endDate;
            $employee->save();

            // Tạo chi tiết nhân viên
            $employeeDetail = new EmployeeDetail();
            $employeeDetail->employee_id = $employee->id;
            $employeeDetail->name = $fullName;
            $employeeDetail->email = $email;
            $employeeDetail->gender = $gender;
            $employeeDetail->date_of_birth = Carbon::now()->subYears(rand(20, 50));
            $employeeDetail->identity_number = 'ID-' . rand(100000, 999999);
            $employeeDetail->phone = '0' . rand(9, 9) . rand(10000000, 99999999);
            $employeeDetail->address = 'Địa chỉ ' . $i . ', Phường ' . rand(1, 12) . ', Quận ' . rand(1, 12) . ', TP. Hồ Chí Minh';
            $employeeDetail->photo = 'profile-picture.jpg';
            $employeeDetail->cv = 'cv.jpg';
            $employeeDetail->last_education = ['THPT', 'Cao đẳng', 'Đại học', 'Thạc sĩ'][rand(0, 3)];
            $employeeDetail->gpa = (rand(25, 40) / 10);
            $employeeDetail->work_experience_in_years = rand(0, 15);
            $employeeDetail->save();

            // Tạo dữ liệu nghỉ phép
            EmployeeLeave::create([
                'employee_id' => $employee->id,
                'leaves_quota' => 12, // Mặc định 12 ngày nghỉ phép
                'used_leaves' => rand(0, 5) // Đã sử dụng 0-5 ngày
            ]);
        }
    }
}
