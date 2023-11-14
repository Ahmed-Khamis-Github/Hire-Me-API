@extends('layouts.dashboard')
@section('content')
<div class="card">
    <div class="card-header border-transparent">
        <h2>Skills</h2>
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
            <th>Skill ID</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($skills as $key => $skill)
          <tr>
            <td><a href="pages/examples/invoice.html">{{$key + 1}}</a></td>
            <td>{{$skill->name}}</td>

            <td>
              <div class="sparkbar" data-color="#00a65a" data-height="20">
                <a href="{{route('skills.edit', $skill->id)}}" class="btn btn-sm btn-warning float-left mr-3">Edit</a>
              </div>
              <form method="post" action="{{route('skills.destroy', $skill->id)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger float-left" >  <i class="fas fa-trash" >
                </i>Delete</button>
            </form>
            </td>
          </tr>
          @endforeach


          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <div class="mx-3">
        {{ $skills->links() }}
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <a href="{{route('skills.create')}}" class="btn btn-sm btn-info float-left" >Add new Skill</a>

    </div>
    <!-- /.card-footer -->
  </div>
@endsection
