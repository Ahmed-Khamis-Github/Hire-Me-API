@extends('layouts.dashboard')

@section('content')
    <div class="card card-info">
        <form action="{{ route('contact.update', $admin->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input name="first_name" type="text" class="form-control" id="first_name" value="{{ $admin->first_name }}" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $admin->last_name}}" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" class="form-control" id="email" value="{{ $admin->email }}" placeholder="User Email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="mobile_number" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                        <input name="mobile_number" type="mobile" class="form-control" id="mobile_number" value="{{ $admin->mobile_number }}" placeholder="Mobile Number">
                    </div>
                </div>

                @foreach ($admin->socials as $social)
                    <div class="form-group row">
                        <label for="github" class="col-sm-2 col-form-label">Github</label>
                        <div class="col-sm-10">
                            <input name="github" type="text" class="form-control" id="github" value="{{ $social->github_account }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="linkedin" class="col-sm-2 col-form-label">Linkedin</label>
                        <div class="col-sm-10">
                            <input name="linkedin" type="text" class="form-control" id="linkedin" value="{{ $social->linkedin_account }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                        <div class="col-sm-10">
                            <input name="twitter" type="text" class="form-control" id="twitter" value="{{ $social->twitter_account }}">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info d-block m-auto">Update</button>
            </div>
        </form>
    </div>
@endsection
