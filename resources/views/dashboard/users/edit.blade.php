@extends('layouts.dashboard')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit User '{{ $user->first_name . ' ' . $user->last_name }}'</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('users.update', $user->id) }}" method="post" class="form-horizontal"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input name="first_name" type="text" class="form-control" id="first_name"
                            value="{{ $user->first_name }}" placeholder="User First Name">
							       {{-- show validation errors --}}
								   @error('first_name')
								   <div class="text-danger mb-4">{{ $message }}</div>
							   @enderror
                    </div>
                </div>



                <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input name="last_name" type="text" class="form-control" id="last_name"
                            value="{{ $user->last_name }}" placeholder="User Last Name">
							   {{-- show validation errors --}}
							   <div class="text-danger  mb-4">
								@error('last_name')
									{{ $message }}
								@enderror
							</div>
                    </div>
                </div>



                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}"
                            placeholder="User Email">
							 {{-- show validation errors --}}
							 <div class="text-danger  mb-4">
								@error('email')
									{{ $message }}
								@enderror
							</div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" id="title" value="{{ $user->title }}"
                            placeholder="User Title">
							  {{-- show validation errors --}}
							  <div class="text-danger  mb-4">
								@error('title')
									{{ $message }}
								@enderror
							</div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="mobile_number" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                        <input name="mobile_number" type="number" class="form-control" id="mobile_number"
                            value="{{ $user->mobile_number }}" placeholder="Job mobile_number">
							  {{-- show validation errors --}}
							  <div class="text-danger  mb-4">
								@error('mobile_number')
									{{ $message }}
								@enderror
							</div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="nationality" class="col-sm-2 col-form-label">Nationality</label>
                    <div class="col-sm-10">
                        <input name="nationality" type="text" class="form-control" id="nationality"
                            value="{{ $user->nationality }}" placeholder="User nationality">
							  {{-- show validation errors --}}
							  <div class="text-danger  mb-4">
								@error('nationality')
									{{ $message }}
								@enderror
							</div>
                    </div>
                </div>




                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                        <input name="about" type="text" class="form-control" id="about" placeholder="User About"
                            value="{{ $user->about }}">
							     {{-- show validation errors --}}
								 <div class="text-danger  mb-4">
									@error('about')
										{{ $message }}
									@enderror
								</div>
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
