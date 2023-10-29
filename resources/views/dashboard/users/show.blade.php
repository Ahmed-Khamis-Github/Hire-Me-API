@extends('layouts.dashboard')
@section('content')
    <div class="container p-1">

        <div class="card" style="width: 65%;
    margin: 100px auto;">
            <div class="card-header" style="color:#1455b4fa">
                {{ $user->first_name . ' ' . $user->last_name." " }}  details
            </div>
            <div class="card-body">
                <p class="card-text">Name :  {{ $user->first_name . ' ' . $user->last_name}}</p>
                <p class="card-text">Email : {{$user->email }}</p>
                <p class="card-text">Title : {{$user->title }}</p>
                <p class="card-text">Nationality : {{$user->nationality }}</p>
                <p class="card-text">Mobile : {{ $user->mobile_number }}</p>
                <p class="card-text">CV : {{ $user->cv }}</p>
                <p class="card-text">Avatar : {{ $user->avatar }}</p>
                <p class="card-text">About : {{ $user->about }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Go To All Users</a>
                <a href="{{ route('users.edit' , $user->id) }}" class="btn btn-warning">Edit This User</a>
            </div>
        </div>

    </div>
@endsection
