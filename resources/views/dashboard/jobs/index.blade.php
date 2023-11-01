@extends('layouts.dashboard')
@section('content')
    <div >
        <div class="card">
            <div class="card-header border-transparent">
                <h2>Jobs</h2>
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
                                <th>Job ID</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->name }}</td>
                                    <td><span>{{ $job->company->company_name }}</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            <a href="{{ route('jobs.show', $job->id) }}"
                                                class="btn btn-sm btn-info float-left">Show</a>
                                        </div>


                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                <a href="{{ route('jobs.edit' , $job->id) }}" class="btn btn-sm btn-warning float-left mx-3">Edit</a>
                                        </div>



                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
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
          {{ $jobs->links() }}
    </div>
@endsection



