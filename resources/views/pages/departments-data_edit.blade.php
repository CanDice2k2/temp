@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'data'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Dữ liệu phòng ban</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Chỉnh sửa phòng ban</h5>
        <form action="{{ route('departments-data.update', ['department' => $department->id ]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="name">Tên:</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $department->name }}" placeholder="Nhập tên phòng ban" required>
                </div>
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="code">Mã phòng ban (chính xác 3 ký tự):</label>
                  <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ $department->code }}" placeholder="Nhập mã phòng ban (3 ký tự)" required maxlength="3">
                </div>
                @error('code')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="Address">Địa chỉ:</label>
                  <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ $department->address }}" placeholder="Nhập địa chỉ phòng ban" required>
                </div>
                @error('address')
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
