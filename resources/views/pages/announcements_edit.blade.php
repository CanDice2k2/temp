@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'announcements'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Thông báo</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Chỉnh sửa thông báo</h5>
        <form action="{{ route('announcements.update', ['announcement' => $announcement->id ]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="title">Tiêu đề:</label>
                  <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $announcement->title }}" placeholder="Nhập tiêu đề" required>
                </div>
                @error('title')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="description">Mô tả:</label>
                  <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $announcement->description }}" placeholder="Nhập mô tả" required>
                </div>
                @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="department_id">Dành cho:</label>
                  <select id="department_id" class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                    <option value="">Tất cả</option>
                    @foreach ($departments as $department)
                      <option value="{{ $department->id }}" {{ $department->id == $announcement->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                  </select>
                </div>
                @error('department_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              {{-- <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="attachment">Tệp đính kèm:</label>
                  <input type="file" name="attachment" id="attachment" class="form-control-file @error('attachment') is-invalid @enderror">
                </div>
                @error('attachment')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div> --}}
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
