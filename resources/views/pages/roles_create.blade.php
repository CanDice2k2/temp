@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'accounts'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Chức Vụ</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <h5 class="text-center font-weight-bold mb-3">Tạo Chức Vụ Mới</h5>
      <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nhập tên chức vụ" required>
              </div>
              @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12">
              <div class="form-check">
                <input type="hidden" name="is_super_user" value="0">
                <input type="checkbox" class="form-check-input @error('is_super_user') is-invalid @enderror" id="is_super_user" name="is_super_user" value="1"  {{ old('is_super_user' ? 'checked' : '') }}>
                <label class="form-check-label" for="is_super_user">Là Quản Trị Viên?</label>
              </div>
              @error('is_super_user')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          @foreach ($menus as $menu)
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label class="d-block">{{ Str::ucfirst($menu->name) }}</label>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="menuAndAccessLevel[{{ $loop->index }}][{{ $menu->id }}]" id="{{ $menu->name }}_disabled" value="0" required {{ old("menuAndAccessLevel[$loop->index][$menu->id]") == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $menu->name }}_disabled">
                      Vô Hiệu Hóa
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="menuAndAccessLevel[{{ $loop->index }}][{{ $menu->id }}]" id="{{ $menu->name }}_view" value="1" {{ old("menuAndAccessLevel[$loop->index][$menu->id]") == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $menu->name }}_view">
                      Xem
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="menuAndAccessLevel[{{ $loop->index }}][{{ $menu->id }}]" id="{{ $menu->name }}_all" value="2" {{ old("menuAndAccessLevel[$loop->index][$menu->id]") == '2' ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $menu->name }}_all">
                      Tất Cả
                    </label>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
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
@endsection
