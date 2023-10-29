@extends('layouts.dashboard')
@section('content')

<form method="post" class="form-horizontal" action="{{ route('categories.store') }}" >
    @csrf
    <div class="card-body">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="name"name="name" class="form-control" id="inputEmail3" placeholder="E.x Marketing">
        </div>
      </div>
      <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <input type="description"  name="description"  class="form-control" id="inputPassword3" placeholder=" Description">
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
