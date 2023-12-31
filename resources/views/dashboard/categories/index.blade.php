@extends('layouts.dashboard')
@section('content')
<div class="card">
    <div class="card-header border-transparent">

        <h2>Categories</h2>
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
            {{-- <th>Category ID</th> --}}
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
          <tr>
            {{-- <td><a href="pages/examples/invoice.html">{{$key + 1}}</a></td> --}}
            <td>{{$category->name}}</td>

            <td><span>{{$category->description}}</span></td>
            <td>
              <div class="sparkbar" data-color="#00a65a" data-height="20" >
                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-sm btn-warning float-left mr-3">Edit</a>
                <form method="post" action="{{route('categories.destroy', $category->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger float-left" >  <i class="fas fa-trash" >
                    </i>Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach


          </tbody>
        </table>
      </div>

      <!-- /.table-responsive -->
    </div>
<div class="mx-3">
    {{ $categories->links() }}
</div>

    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <a href="{{route('categories.create')}}" class="btn btn-sm btn-info float-left" >Add new Category</a>

    </div>

    <!-- /.card-footer -->
  </div>
@endsection
