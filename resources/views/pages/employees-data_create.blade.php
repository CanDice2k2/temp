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
        <h5 class="text-center font-weight-bold mb-3">Tạo nhân viên</h5>
        <form action="{{ route('employees-data.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <h6 class="font-weight-bold">Thông tin tài khoản</h6>
            <hr>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="name">Tên:</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nhập tên" required>
                </div>
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Nhập email" required>
                </div>
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="password">Mật khẩu:</label>
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Nhập mật khẩu" required>
                </div>
                @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="password_confirmation">Xác nhận mật khẩu:</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Nhập lại mật khẩu" required>
                </div>
                @error('password_confirmation')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="role_id">Chức vụ:</label>
                  <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                    <option value="">Chọn...</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected': '' }}>
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
          </div>

          <div class="mb-3">
            <h6 class="font-weight-bold">Thông tin nhân viên</h6>
            <hr>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="start_of_contract">Ngày bắt đầu hợp đồng:</label>
                  <input type="date" name="start_of_contract" id="start_of_contract" class="form-control @error('start_of_contract') is-invalid @enderror" value="{{ old('start_of_contract') }}" placeholder="Nhập ngày bắt đầu" required>
                </div>
                @error('start_of_contract')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="end_of_contract">Ngày kết thúc hợp đồng:</label>
                  <input type="date" name="end_of_contract" id="end_of_contract" class="form-control @error('end_of_contract') is-invalid @enderror" value="{{ old('end_of_contract') }}" placeholder="Nhập ngày kết thúc" required>
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
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected': '' }}>
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
                    <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected': '' }}>
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
                    <option selected value="">Chọn...</option>
                    <option value="M" {{ old('gender') == "M" ? 'selected': '' }}>Nam</option>
                    <option value="F" {{ old('gender') == "F" ? 'selected': '' }}>Nữ</option>
                  </select>
                </div>
                @error('gender')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="date_of_birth">Ngày sinh:</label>
                  <input type="date" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" placeholder="Nhập ngày sinh" required>
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
                  <input type="text" name="identity_number" id="identity_number" class="form-control @error('identity_number') is-invalid @enderror" value="{{ old('identity_number') }}" placeholder="Nhập số CCCD" required>
                </div>
                @error('identity_number')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="phone">Số điện thoại:</label>
                  <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
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
                  <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Nhập địa chỉ" required>
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
                  <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror" required>
                </div>
                @error('photo')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div> --}}
              {{-- <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="cv">CV:</label>
                  <input type="file" name="cv" id="cv" class="form-control-file @error('cv') is-invalid @enderror" required>
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
                  <input type="text" name="last_education" id="last_education" class="form-control @error('last_education') is-invalid @enderror" value="{{ old('last_education') }}" placeholder="Nhập trình độ học vấn" required>
                </div>
                @error('last_education')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="gpa">GPA:</label>
                  <input type="text" name="gpa" id="gpa" class="form-control @error('gpa') is-invalid @enderror" value="{{ old('gpa') }}" placeholder="Nhập GPA" required>
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
                  <input type="number" name="work_experience_in_years" id="work_experience_in_years" class="form-control @error('work_experience_in_years') is-invalid @enderror" value="{{ old('work_experience_in_years') }}" placeholder="Nhập số năm kinh nghiệm" required>
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
