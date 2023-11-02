@extends('layouts.dashboard')
@section('content')
<div class="container">

    <form method="post" action="{{route('categories.update', $category->id)}}">
        @csrf
        @method('PUT')
        {{$errors}}
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="E.x Marketing" value="{{ old('name', $category->name) }}">
                    {{-- <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span> --}}

                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="{{ old('description', $category->description) }}">
                    <span class="text-danger">
                        @error('description')
                            {{ $message }}
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
