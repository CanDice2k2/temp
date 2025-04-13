@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'performance'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Điểm hiệu suất làm việc của nhân viên</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
        <h5 class="text-center font-weight-bold mb-3">Chi tiết điểm của nhân viên</h5>
        <div class="mb-3">
          <h6 class="font-weight-bold">Thông tin nhân viên</h6>
          <hr>
          <div class="row">
            <div class="col-sm-12 col-lg-6 offset-lg-6">
              <div class="form-group">
                <label for="date">Ngày:</label>
                <input type="text" id="date" value="{{ $employeeScore->created_at }}" class="form-control-plaintext" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-lg-6">
              <div class="form-group">
                <label for="employee_id">Tên nhân viên:</label>
                <input type="text" id="employee_id" value="{{ $employeeScore->employee->employeeDetail->name }}" class="form-control-plaintext" readonly>
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-group">
                <label for="scored_by">Người đánh giá:</label>
                <input type="text" id="scored_by" value="{{ $employeeScore->scoredBy->employeeDetail->name }}" class="form-control-plaintext" readonly>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <h6 class="font-weight-bold">Điểm</h6>
          <hr>
          @foreach ($scores as $score)
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="score">{{ Str::ucfirst(Str::lower($score->scoreCategory->name)) }}:</label>
                <input type="text" id="score" value="{{ $score->score }}" class="form-control-plaintext" readonly>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
  </div>

  @if (collect($accesses)->where('menu_id', 3)->first()->status == 2 && $employeeScore->scored_by == auth()->user()->employee->id)
    <div class="row">
      <div class="col-12">
        <form action="{{ route('employees-performance-score.edit', ['employeeScore' => $employeeScore->group_id]) }}" class="d-inline-block">
          <button type="submit" class="btn btn-warning mr-2 px-5">Chỉnh sửa</button>
        </form>
        <form action="{{ route('employees-performance-score.destroy', ['employeeScore' => $employeeScore->group_id]) }}" method="POST" class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger mr-2 px-5" onclick="return confirm('Bạn có chắc chắn muốn xóa điểm này không?')">Xóa</button>
        </form>
      </div>
    </div>
  @endif
</div>
@endsection
