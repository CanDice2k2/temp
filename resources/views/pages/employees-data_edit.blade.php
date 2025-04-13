@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'data'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Dữ liệu nhân viên</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Chỉnh sửa nhân viên</h5>
        <form action="{{ route('employees-data.update', ['employee' => $employee->id ]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <h6 class="font-weight-bold">Thông tin tài khoản</h6>
            <hr>

            <input type="hidden" name="user_id" value="{{ $employee->user_id }}">

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="name">Tên:</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $employee->employeeDetail->name }}" placeholder="Nhập tên" required>
                </div>
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $employee->employeeDetail->email }}" placeholder="Nhập email" required>
                </div>
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="password">Mật khẩu (để trống nếu không thay đổi):</label>
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu mới nếu muốn thay đổi">
                </div>
                @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <!-- Khoảng trống -->
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="role_id">Chức vụ:</label>
                  <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                    <option value="">Chọn...</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $employee->user->role_id == $role->id ? 'selected': '' }}>
                      {{ $role->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                @error('role_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="form-check">
                  <input type="hidden" name="is_active" value="0">
                  <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" value="1"  {{ old('is_active', isset($employee->is_active) ? 'checked' : '') }}>
                  <label class="form-check-label" for="is_active">Hoạt động?</label>
                </div>
                @error('is_active')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <h6 class="font-weight-bold">Thông tin nhân viên</h6>
            <hr>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="start_of_contract">Ngày bắt đầu hợp đồng:</label>
                  <input type="date" name="start_of_contract" id="start_of_contract" class="form-control @error('start_of_contract') is-invalid @enderror" value="{{ $employee->start_of_contract }}" placeholder="Nhập ngày bắt đầu" required>
                </div>
                @error('start_of_contract')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="end_of_contract">Ngày kết thúc hợp đồng:</label>
                  <input type="date" name="end_of_contract" id="end_of_contract" class="form-control @error('end_of_contract') is-invalid @enderror" value="{{ $employee->end_of_contract }}" placeholder="Nhập ngày kết thúc" required>
                </div>
                @error('end_of_contract')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="department_id">Phòng ban:</label>
                  <select id="department_id" class="form-control @error('department_id') is-invalid @enderror" name="department_id" required>
                    <option value="">Chọn...</option>
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected': '' }}>
                      {{ $department->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                @error('department_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="position_id">Vị trí:</label>
                  <select id="position_id" class="form-control @error('position_id') is-invalid @enderror" name="position_id" required>
                    <option value="">Chọn...</option>
                    @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ $employee->position_id == $position->id ? 'selected': '' }}>
                      {{ $position->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                @error('position_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="gender">Giới tính:</label>
                  <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                    <option selected>Chọn...</option>
                    <option value="M"
                    @if ($employee->employeeDetail->gender == "M")
                      selected
                    @endif
                    >Nam</option>
                    <option value="F"
                      @if ($employee->employeeDetail->gender == "F")
                        selected
                      @endif
                    >Nữ</option>
                  </select>
                </div>
                @error('gender')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="date_of_birth">Ngày sinh:</label>
                  <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ $employee->employeeDetail->date_of_birth }}" placeholder="Nhập ngày sinh" required>
                </div>
                @error('date_of_birth')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="identity_number">Số CCCD:</label>
                  <input type="text" name="identity_number" id="identity_number" class="form-control @error('identity_number') is-invalid @enderror" value="{{ $employee->employeeDetail->identity_number }}" placeholder="Nhập số CCCD" required>
                </div>
                @error('identity_number')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="phone">Số điện thoại:</label>
                  <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $employee->employeeDetail->phone }}" placeholder="Nhập số điện thoại" required>
                </div>
                @error('phone')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="address">Địa chỉ:</label>
                  <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ $employee->employeeDetail->address }}" placeholder="Nhập địa chỉ" required>
                </div>
                @error('address')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              {{-- <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="photo">Photo:</label>
                  <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                </div>
                @error('photo')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="cv">CV:</label>
                  <input type="file" name="cv" id="cv" class="form-control-file @error('cv') is-invalid @enderror">
                </div>
                @error('cv')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div> --}}
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="last_education">Học vấn:</label>
                  <input type="text" name="last_education" id="last_education" class="form-control @error('last_education') is-invalid @enderror" value="{{ $employee->employeeDetail->last_education }}" placeholder="Nhập trình độ học vấn" required>
                </div>
                @error('last_education')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="gpa">GPA:</label>
                  <input type="text" name="gpa" id="gpa" class="form-control @error('gpa') is-invalid @enderror" value="{{ $employee->employeeDetail->gpa }}" placeholder="Nhập GPA" required>
                </div>
                @error('gpa')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="work_experience_in_years">Số năm kinh nghiệm:</label>
                  <input type="number" name="work_experience_in_years" id="work_experience_in_years" class="form-control @error('work_experience_in_years') is-invalid @enderror" value="{{ $employee->employeeDetail->work_experience_in_years }}" placeholder="Nhập số năm kinh nghiệm" required>
                </div>
                @error('work_experience_in_years')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-group">
                <button type="submit" class="btn btn-primary px-5">Lưu</button>
              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection
