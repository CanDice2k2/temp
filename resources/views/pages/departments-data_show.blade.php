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
    <h5 class="text-center font-weight-bold mb-3">Chi tiết phòng ban</h5>
      <div class="mb-3">
        <div class="row">
          <div class="col-sm-12 col-lg-6">
            <div class="form-group">
              <label for="name">Tên:</label>
              <input type="text" name="name" id="name" class="form-control-plaintext" readonly value="{{ $department->name }}">
            </div>
          </div>
          <div class="col-sm-12 col-lg-6">
            <div class="form-group">
              <label for="code">Mã phòng ban:</label>
              <input type="text" name="code" id="code" class="form-control-plaintext" readonly value="{{ $department->code }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="Address">Địa chỉ:</label>
              <input type="text" name="address" id="address" class="form-control-plaintext" value="{{ $department->address }}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (collect($accesses)->where('menu_id', 2)->first()->status == 2)
    <div class="row">
      <div class="col-12">
        <form action="{{ route('departments-data.edit', ['department' => $department->id]) }}" class="d-inline-block">
          <button type="submit" class="btn btn-warning mr-2 px-5">Chỉnh sửa</button>
        </form>
        <form action="{{ route('departments-data.destroy', ['department' => $department->id]) }}" method="POST" class="d-inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger mr-2 px-5" onclick="return confirm('Are you sure deleting this department?')">Xoá</button>
        </form>
      </div>
    </div>
  @endif
</div>
@endsection
