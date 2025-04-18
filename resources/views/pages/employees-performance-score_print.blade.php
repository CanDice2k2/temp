@extends('layouts.print')

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Điểm hiệu suất làm việc của nhân viên</h4>
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
              <th scope="col" class="table-dark">Tên nhân viên</th>
              <th scope="col" class="table-dark">Điểm</th>
              <th scope="col" class="table-dark">Người đánh giá</th>
              <th scope="col" class="table-dark">Ngày</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($employeeScores as $score)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $score->employee->name }}</td>
              <td>{{ $score->score }}</td>
              <td>{{ $score->scoredBy->name }}</td>
              <td>{{ $score->created_at }}</td>
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
