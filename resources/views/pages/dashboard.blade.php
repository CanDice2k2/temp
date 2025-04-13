@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'dashboard'])

@section('_content')
    <div class="container-fluid mt-2 px-4">
        <div class="row">
            <div class="col-12">
                <h4 class="font-weight-bold">Trang chủ</h4>
                <hr>
            </div>
        </div>

        {{-- @if (!$checkForAttendance)
            <div class="alert alert-warning">
                <h5 class="font-weight-bold">Don't forget to check in / out !</h5>
            </div>
        @endif --}}

        @if (auth()->user()->isAdmin())
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="bg-light text-dark d-flex flex-column justify-content-center align-items-center py-5 card">
                        <h4>Tổng số nhân viên</h4>
                        <h1>{{ $employeesCount }}</h1>
                    </div>
                </div>
                {{-- <div class="col-sm-12 col-lg-6 mb-3">
                    <div class="bg-light text-dark d-flex flex-column justify-content-center align-items-center py-5 card">
                        <h4>Job Applicants</h4>
                        <h1>{{ $announcements  }}</h1>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <div class="bg-light text-dark card p-3">
                        <h4 class="font-weight-bold">Thống kê nhân viên theo phòng ban</h4>
                        <div id="department-gender-chart" style="height: 400px"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <div class="bg-light text-dark card p-3 scrollable">
                        <h4 class="font-weight-bold">Danh sách nhân sự</h4>
                        <table class="table table-light table-striped table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col" class="table-dark">#</th>
                                    <th scope="col" class="table-dark">Tên</th>
                                    <th scope="col" class="table-dark">Thời gian hết hợp đồng</th>
                                    <th scope="col" class="table-dark">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($endingEmployees as $employee)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration + $endingEmployees->firstItem() - 1 }}</th>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->end_of_contract }}</td>
                                        <td><a href="{{ route('employees-data.edit', ['employee' => $employee->id]) }}"
                                                class="btn btn-outline-dark">Chỉnh sửa</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $endingEmployees->links() }}
                    </div>
                </div>
            </div>
            {{--
    <div class="row">
      <div class="col-6 mb-3">
        <div class="bg-light text-dark card p-3">
          <h4>Last 2 Days Attendances</h4>
          <div id="attendances-chart" style="height: 300px">
          </div>
        </div>
      </div>
      <div class="col-6 mb-3">
        <div class="bg-light text-dark card p-3">
          <h4>Monthly Performance</h4>
          <div id="performance-chart" style="height: 300px">
          </div>
        </div>
      </div>
    </div> --}}
        @endif

        <div class="row">
            <div class="col-12 mb-3">
                <div class="bg-light text-dark p-3 card scrollable">
                    <h3>Thông báo</h3>
                    <table class="table table-light table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="table-dark">#</th>
                                <th scope="col" class="table-dark">Tên</th>
                                <th scope="col" class="table-dark">Người tạo</th>
                                <th scope="col" class="table-dark">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcements as $announcement)
                                <tr>
                                    <th scope="row">{{ $loop->iteration + $announcements->firstItem() - 1 }}</th>
                                    <td><a
                                            href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}">{{ $announcement->title }}</a>
                                    </td>
                                    <td>{{ $announcement->creator->name }}</td>
                                    <td>{{ $announcement->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $announcements->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('_script')
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        // Biểu đồ cột chồng phân theo phòng ban và giới tính
        @if (auth()->user()->isAdmin())
            // Chỉ một sự kiện DOMContentLoaded
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    console.log("Chart script is running!");

                    // Convert PHP data to JavaScript arrays for the chart
                    const departments = @json($departmentGenderStats->pluck('department'));
                    const maleEmployees = @json($departmentGenderStats->pluck('male'));
                    const femaleEmployees = @json($departmentGenderStats->pluck('female'));

                    console.log("Departments:", departments);
                    console.log("Male employees:", maleEmployees);
                    console.log("Female employees:", femaleEmployees);

                    // Kiểm tra phần tử DOM tồn tại
                    const chartElement = document.getElementById('department-gender-chart');
                    if (!chartElement) {
                        console.error("Chart element not found!");
                        return;
                    }

                    // Create the department gender chart
                    const departmentGenderChart = echarts.init(chartElement);
                    const departmentGenderOption = {
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['Nam', 'Nữ']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'category',
                            data: departments
                        },
                        yAxis: {
                            type: 'value',
                            name: 'Số lượng nhân viên'
                        },
                        series: [
                            {
                                name: 'Nam',
                                type: 'bar',
                                stack: 'total',
                                itemStyle: {
                                    color: '#5470C6'
                                },
                                data: maleEmployees
                            },
                            {
                                name: 'Nữ',
                                type: 'bar',
                                stack: 'total',
                                itemStyle: {
                                    color: '#EE6666'
                                },
                                data: femaleEmployees
                            }
                        ]
                    };

                    departmentGenderChart.setOption(departmentGenderOption);

                    // Resize chart on window resize
                    window.addEventListener('resize', function() {
                        departmentGenderChart.resize();
                    });
                } catch (error) {
                    console.error("Error setting up department chart:", error);
                }
            });
        @endif
    </script>
@endsection
