@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'data'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Dữ liệu chức vụ</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Chỉnh sửa chức vụ</h5>
        <form action="{{ route('positions-data.update', ['position' => $position->id ]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="name">Tên:</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $position->name }}" placeholder="Nhập tên chức vụ" required>
                </div>
                @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="description">Mô tả:</label>
                  <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $position->description }}" placeholder="Nhập mô tả chức vụ" required>
                </div>
                @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="min_year_exp_required">Kinh nghiệm tối thiểu (năm):</label>
                  <input type="number" name="min_year_exp_required" id="min_year_exp_required" class="form-control @error('min_year_exp_required') is-invalid @enderror" value="{{ $position->min_year_exp_required }}" placeholder="Nhập số năm kinh nghiệm tối thiểu" required>
                </div>
                @error('min_year_exp_required')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                  <label for="salary">Lương:</label>
                  <input type="number" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ $position->salary }}" placeholder="Nhập lương chức vụ" required>
                </div>
                @error('salary')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            {{-- <div class="row">
              <div class="col-12">
                <div class="form-check">
                  <input type="hidden" name="open_for_recruitment" value="0">
                  <input type="checkbox" class="form-check-input @error('open_for_recruitment') is-invalid @enderror" id="open_for_recruitment" name="open_for_recruitment" value="1"  {{ $position->open_for_recruitment ? 'checked' : '' }}>
                  <label class="form-check-label" for="open_for_recruitment">Đang tuyển dụng</label>
                </div>
                @error('open_for_recruitment')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div> --}}
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
