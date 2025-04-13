@extends('layouts.app')

@section('nav')
    @include('components.nav')
@endsection

@section('content')
<div class="container pb-5" id="announcements">
  <div class="row">
      <div class="col-12 text-center">
          <h3>Chi tiết thông báo</h3>
          <div class="line text-center"> &nbsp;</div>
      </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="mb-3">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="title">Tiêu đề:</label>
              <input type="text" name="title" id="title" class="form-control-plaintext" readonly value="{{ $announcement->title }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="description">Mô tả:</label>
              <input type="text" name="description" id="description" class="form-control-plaintext" readonly value="{{ $announcement->description }}">
            </div>
          </div>
        </div>

        {{-- @if ($announcement->attachment !== null)
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="attachment">Tệp đính kèm:</label>
                <br>
                <a href="{{ asset('/storage/' . $announcement->attachment) }}" download="attachment" class="btn btn-outline-dark">
                  <i class="fas fa-download mr-1"></i>
                  Tải xuống
                </a>
              </div>
            </div>
          </div>
        @endif --}}
      </div>
    </div>
  </div>
</div>
@endsection
