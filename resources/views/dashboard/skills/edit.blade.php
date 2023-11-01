@extends('layouts.dashboard')
@section('content')
<div class="container">
    <form method="post" action="{{route('skills.update', $skill->id)}}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="name" name="name" class="form-control" id="inputEmail3" placeholder="E.x Marketing" value={{$skill->name}}>
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
