@extends('layouts.print')

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12 text-center">
        <h4 class="font-weight-bold">Yêu cầu nghỉ phép của nhân viên</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-3 overflow-auto">
        <table class="table table-light table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
              <th scope="col" class="table-dark">#</th>
              <th scope="col" class="table-dark">Tên</th>
              <th scope="col" class="table-dark">Từ ngày</th>
              <th scope="col" class="table-dark">Đến ngày</th>
              <th scope="col" class="table-dark">Lý do</th>
              <th scope="col" class="table-dark">Trạng thái</th>
              <th scope="col" class="table-dark">Người kiểm tra</th>
              <th scope="col" class="table-dark">Bình luận</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($employeeLeaveRequests as $leaveReq)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $leaveReq->employee->name }}</td>
              <td>{{ $leaveReq->from }}</td>
              <td>{{ $leaveReq->to }}</td>
              <td>{{ $leaveReq->message }}</td>
              <td>{{ $leaveReq->status }}</td>
              <td>{{ $leaveReq->checkedBy->name }}</td>
              <td>{{ $leaveReq->comment }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('_script')
    <script>
      window.onload = function () {
        window.print();
      }
    </script>
@endsection
