@extends('layouts.dashboard')
@section('content')
<div class="card">
    <div class="card-header border-transparent">
        <h2>Companies</h2>
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
            <th>Title</th>
            <th>Company Name</th>
            <th>  Full Name </th>
            <th>Location</th>
            <th class="text-center">Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($companies as $company)
          <tr>
            <td>{{$company->title}}</td>
            <td>{{$company->company_name}}</td>
            <td>{{$company->first_name}} {{$company->last_name}}</td>

            <td><span>{{$company->location}}</span></td>

            <td>
              <div class="sparkbar " data-color="#00a65a" data-height="20">
                <a href="{{route('companies.show', $company->id)}}" class="btn btn-sm btn-info float-left">Show</a>
                <a href="{{route('companies.edit', $company->id)}}" class="btn btn-sm btn-warning float-left  mx-3">Edit</a>

                <form method="post" action="{{route('companies.destroy', $company->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger float-left" >  <i class="fas fa-trash ml-2" >
                    </i>Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach


          </tbody>
        </table>
      </div>
	  <div class="mx-3">
		{{ $companies->links() }}
	</div>

      <!-- /.table-responsive -->
    </div>



    <!-- /.card-body -->
    <div class="card-footer clearfix">
      {{-- <a href="{{route('categories.create')}}" class="btn btn-sm btn-info float-left" >Add new Category</a> --}}

    </div>

    <!-- /.card-footer -->
  </div>
@endsection
