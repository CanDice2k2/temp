@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'leave-request'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Yêu cầu nghỉ phép của nhân viên</h4>
        <hr>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Tạo yêu cầu nghỉ phép mới</h5>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('employees-leave-request.store') }}" method="POST">
          @csrf
          <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->id }}">
          <div class="mb-3">
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="from">Từ ngày:</label>
                  <input type="date" name="from" id="from" class="form-control @error('from') is-invalid @enderror" value="{{ old('from') }}" placeholder="Nhập ngày bắt đầu" required>
                </div>
                @error('from')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="to">Đến ngày:</label>
                  <input type="date" name="to" id="to" class="form-control @error('to') is-invalid @enderror" value="{{ old('to') }}" placeholder="Nhập ngày kết thúc" required>
                </div>
                @error('to')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="message">Lý do:</label>
                  <input type="text" name="message" id="message" class="form-control @error('message') is-invalid @enderror" value="{{ old('message') }}" placeholder="Nhập lý do" required>
                </div>
                @error('message')
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
