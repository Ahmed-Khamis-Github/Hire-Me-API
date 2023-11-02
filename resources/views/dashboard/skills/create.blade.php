@extends('layouts.dashboard')
@section('content')

<form method="post" class="form-horizontal" action="{{ route('skills.store') }}" >
    @csrf
    <div class="card-body">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text"name="name" class="form-control" id="inputEmail3" placeholder="E.x Marketing">
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-info">Submit</button>

    </div>
    <!-- /.card-footer -->
  </form>
@endsection
