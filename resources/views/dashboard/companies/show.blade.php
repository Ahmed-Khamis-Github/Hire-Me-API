{{-- @extends('layouts.dashboard')
@section('content')

<div class="container p-1">

    <div class="card" style="width: 65%;
    margin: 100px auto;">
        <div class="card-header" style="color:#1455b4fa">
          {{ $company->company_name }} Company details
        </div>
        <div class="card-body">
          <p class="card-text"><span class="fw-bolder text-lg">Title</span> : {{ $company->title}}</p>
          <p class="card-text "><span class="fw-bolder text-lg">Name</span> : {{ $company->first_name }} {{$company->last_name}}</p>
          <p class="card-text"><span class="fw-bolder text-lg">Email</span>: {{ $company->email }}</p>
          <p class="card-text"><span class="fw-bolder text-lg">Location</span>: {{ $company->location }}</p>
          <p class="card-text"><span class="fw-bolder text-lg">Mobile</span>: {{ $company->mobile_number}}</p>
          <p class="card-text"><span class="fw-bolder text-lg">About</span>: {{ $company->about }}</p>

          <a href="{{ route('companies.index') }}" class="btn btn-primary">Go To All Companies</a>
        </div>
      </div>

</div>
@endsection --}}


@extends('layouts.dashboard')

@section('content')

<div class="card card-primary  " style="width: 65%; margin: 100px auto;">
    <div class="card-header">
      <h3 class="card-title"> {{ $company->company_name }} Company Details</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="d-flex">
            <strong>Title:  </strong>
        <p class="text-muted px-3">
			{{ $company->title}}
        </p>
        </div>

        <hr>
        <div class="d-flex">
            <strong>Name:  </strong>
        <p class="text-muted px-3">
			{{ $company->first_name }} {{$company->last_name}}
        </p>
        </div>


        <hr>
        <div class="d-flex">
            <strong>Email:  </strong>
        <p class="text-muted px-3">
			{{ $company->email }}
        </p>
        </div>
      <hr>

      <div class="d-flex">
        <strong>Mobile </strong>
    <p class="text-muted px-3">
       {{ $company->mobile_number}}
    </p>
    </div>
	<hr>

	<div class="d-flex">
	  <strong>Location </strong>
  <p class="text-muted px-3">
	 {{ $company->location}}
  </p>
  </div>
<hr>

<div class="d-flex">
  <strong>About </strong>
<p class="text-muted px-3">
 {{ $company->about}}
</p>
</div>


		<a href="{{ route('companies.index') }}" class="btn btn-primary float-right col-3">Go To All Companies</a>
    <!-- /.card-body -->
        </div>

    </div>
@endsection


