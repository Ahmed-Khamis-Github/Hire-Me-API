@extends('layouts.dashboard')
@section('content')

<div class="container p-1">

    <div class="card" style="width: 65%;
    margin: 100px auto;">
        <div class="card-header" style="color:#1455b4fa">
          {{ $job->name }} job details
        </div>
        <div class="card-body">
          <p class="card-text">Min_Salary : {{ $job->min_salary }}</p>
          <p class="card-text">Max_Salary : {{ $job->max_salary }}</p>
          <p class="card-text">Company : {{ $job->company->company_name }}</p>
          <p class="card-text">Type : {{ $job->type }}</p>
          <p class="card-text">Location : {{ $job->location }}</p>
          <p class="card-text">About : {{ $job->about }}</p>
          <a href="{{ route('jobs.index') }}" class="btn btn-primary">Go To All Jobs</a>
        </div>
      </div>
       
</div>
@endsection