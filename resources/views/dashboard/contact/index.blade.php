@extends('layouts.dashboard')

@section('content')

<div class="card card-primary  " style="width: 65%; margin: 100px auto;">
    <div class="card-header">
      <h3 class="card-title">About Me</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="d-flex">
            <strong>First Name:  </strong>
        <p class="text-muted px-3">
           {{ $admin->first_name }}
        </p>
        </div>

        <hr>
        <div class="d-flex">
            <strong>Last Name:  </strong>
        <p class="text-muted px-3">
           {{ $admin->last_name }}
        </p>
        </div>


        <hr>
        <div class="d-flex">
            <strong>Email:  </strong>
        <p class="text-muted px-3">
           {{ $admin->email}}
        </p>
        </div>
      <hr>

      <div class="d-flex">
        <strong>Mobile </strong>
    <p class="text-muted px-3">
       {{ $admin->mobile_number}}
    </p>
    </div>
<hr>
      <strong> Social Links:</strong>


        @if ($admin->socials->count() > 0)
            <ul>
                @foreach ($admin->socials as $social)
                       <li>
                        <strong>Github: </strong>
                        {{ $social->github_account }}
                       </li>
                       <li>
                        <strong >Linkedin: </strong>
                        {{ $social->linkedin_account }}
                       </li>
                       <li>
                        <strong>Twitter: </strong>
                        {{ $social->twitter_account }}
                       </li>

                @endforeach
            </ul>
        @else
            <p>No social links available for this admin.</p>
        @endif
        <a href="{{ route('contact.edit' , $admin->id) }}" class="btn btn-warning float-right col-2">Edit</a>
    <!-- /.card-body -->
        </div>

    </div>
@endsection


