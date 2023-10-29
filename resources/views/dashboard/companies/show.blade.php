@extends('layouts.dashboard')
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
          <p class="card-text"><span class="fw-bolder text-lg">Nationality</span> : {{ $company->nationality }}</p>
          <a href="{{ route('companies.index') }}" class="btn btn-primary">Go To All Companies</a>
        </div>
      </div>

</div>
@endsection
