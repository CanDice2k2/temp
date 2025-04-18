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
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-3 overflow-auto">
        <div class="d-flex justify-content-between">
          @if (collect($accesses)->where('menu_id', 6)->first()->status == 2)
            <a href="{{ route('announcements.create') }}" class="btn btn-outline-dark mb-3 w-25">
              <i class="fas fa-plus mr-1"></i>
                <span> Tạo mới</span>
            </a>
          @endif
          <a href="{{ route('announcements.print') }}" class="btn btn-outline-dark mb-3 w-25" target="_blank">
            <i class="fas fa-print mr-1"></i>
              <span> In</span>
          </a>
        </div>

        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <table class="table table-light table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
              <th scope="col" class="table-dark">#</th>
              <th scope="col" class="table-dark">Tiêu đề</th>
              <th scope="col" class="table-dark">Mô tả</th>
              {{-- <th scope="col" class="table-dark">Tệp đính kèm</th> --}}
              <th scope="col" class="table-dark">Người tạo</th>
              <th scope="col" class="table-dark">Dành cho</th>
              <th scope="col" class="table-dark">Ngày</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($announcements as $announcement)
            <tr>
              <th scope="row">{{ $loop->iteration + $announcements->firstItem() - 1 }}</th>
              <td class="w-25"><a href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}">{{ $announcement->title }}</a></td>
              <td class="w-25">{{ $announcement->description }}</td>
              {{-- <td><a href="{{ asset('/storage/'. $announcement->attachment ) }}" target="_blank">Xem</a></td> --}}
              <td>{{ $announcement->creator->name }}</td>
              <td>{{ $announcement->department_id ? $announcement->department->name : 'TẤT CẢ' }}</td>
              <td>{{ $announcement->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $announcements->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
