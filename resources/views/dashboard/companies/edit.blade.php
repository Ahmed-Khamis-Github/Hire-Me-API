@extends('layouts.dashboard')
@section('content')
<div class="container">
    <form method="post" action="{{route('companies.update', $company->id)}}">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group row">
              <label for="title" class="col-sm-2 col-form-label">title</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control" value={{$company->title}}>
                <span class="text-danger">
                @error('title')
                {{$message}}
                @enderror
                </span>

              </div>
            </div>
            <div class="form-group row">
              <label for="company_name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="company_name" class="form-control" value={{$company->company_name}}>
                <span class="text-danger">
                @error('company_name')
                {{$message}}
                @enderror
                </span>
              </div>
            </div>
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" name="first_name" class="form-control"  placeholder="First Name" value={{$company->first_name}} >
                  <span class="text-danger">
                  @error('first_name')
                  {{$message}}
                  @enderror
                  </span>


                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" name="last_name" class="form-control"placeholder="Last Name" value={{$company->last_name}}>
                  <span class="text-danger">
                  @error('last_name')
                  {{$message}}
                  @enderror
                  </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-sm-2 col-form-label">location</label>
                <div class="col-sm-10">
                  <input type="text" name="location" class="form-control" placeholder="Location" value={{$company->location}}>
                  <span class="text-danger">
                  @error('location')
                  {{$message}}
                  @enderror
                  </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile number" class="col-sm-2 col-form-label">Mobile</label>
                <div class="col-sm-10">
                  <input type="text" name="mobile number" class="form-control"  placeholder="Mobile Number" value={{$company->mobile_number}}>
                  <span class="text-danger">
                  @error('mobile_number')
                  {{$message}}
                  @enderror
                  </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" name="email" class="form-control" id="email" placeholder="Email" value={{$company->email}}>
                  <span class="text-danger">
                  @error('email')
                  {{$message}}
                  @enderror
                  </span>
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
