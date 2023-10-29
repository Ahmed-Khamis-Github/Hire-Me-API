@extends('layouts.dashboard')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Job '{{ $job->name }}'</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('jobs.update', $job->id) }}" method="post" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" id="name"
                        value="{{ $job->name }}" placeholder="Job Name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                        <input name="type" type="text" class="form-control" id="type" 
                        value="{{ $job->type }}" placeholder="Job Type">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="loc" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        <input name="location" type="text" class="form-control" id="loc"
                        value="{{ $job->location }}" placeholder="Job Location">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="min-sal" class="col-sm-2 col-form-label">Min_Salary</label>
                    <div class="col-sm-10">
                        <input name="min_salary" type="number" class="form-control" id="min-sal"
                        value="{{ $job->min_salary }}" placeholder="Job Min Salary">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="max-sal" class="col-sm-2 col-form-label">Max_Salary</label>
                    <div class="col-sm-10">
                        <input name="max_salary" type="number" class="form-control" id="max-sal"
                        value="{{ $job->max_salary }}" placeholder="Job Max Salary">
                    </div>
                </div>



                <div class="form-group row">
                    <label for="cat" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="exampleFormControlSelect1"
                        value="{{ $job->category->name }}" >
                           @foreach ($categories as $category )
                               <option value="{{ $category->id }}">{{ $category->name }}</option>
                           @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                        <input name="about" type="text" class="form-control" id="about" placeholder="Job About">
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer ">
                <button type="submit" class="btn btn-info d-block m-auto">Update</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
