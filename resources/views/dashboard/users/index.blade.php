@extends('layouts.dashboard')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header border-transparent">
                <h2>All Users</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>user ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Avatar</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name." ".$user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->title }}</td>
                                    <td>{{ $user->avatar }}</td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="btn btn-sm btn-info float-left">Show</a>
                                        </div>


                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                <a href="{{ route('users.edit' , $user->id) }}" class="btn btn-sm btn-warning float-left">Edit</a>
                                        </div>



                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-danger float-left">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

                <!-- /.table-responsive -->
            </div>

            <!-- /.card-body -->

            <!-- /.card-footer -->
        </div>
         {{-- display pagination  --}}
         {{ $users->links() }}
    </div>
@endsection
