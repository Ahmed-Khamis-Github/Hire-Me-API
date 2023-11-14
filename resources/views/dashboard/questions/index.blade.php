@extends('layouts.dashboard')
@section('content')
<div class="card">
    <div class="card-header border-transparent">
        <h2>Questions</h2>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
          <tr>
            <th>Question ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($questions as $key => $question)
          <tr>
            <td><a href="pages/examples/invoice.html">{{$key + 1}}</a></td>
            <td>{{$question->name}}</td>
            <td><span>{{$question->email}}</span></td>
            <td>{{$question->subject}}</td>
            <td><span>{{$question->message}}</span></td>
          </tr>
          @endforeach


          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
	<div class="mx-3">
		{{ $questions->links() }}
	</div>
    <!-- /.card-body -->
    <!-- /.card-footer -->
  </div>
@endsection
