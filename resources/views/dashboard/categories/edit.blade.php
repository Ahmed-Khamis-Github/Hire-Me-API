@extends('layouts.dashboard')
@section('content')
<div class="container">
    <form method="post" action="{{route('categories.update', $category->id)}}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="name" name="name" class="form-control" id="inputEmail3" placeholder="E.x Marketing" value={{$category->name}}>
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="description" name="description" class="form-control" id="inputPassword3" placeholder=" Description" value={{$category->description}}>
              </div>
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>

          </div>




</form>
</div>
@endsection
