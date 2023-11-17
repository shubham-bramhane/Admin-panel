@extends('admin.layout.default')


@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Role List</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            @include('admin.layout.partial.alert')
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created at</th>
                                    @can('roles-status')
                                    <th scope="col">Status</th>
                                    @endcan
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->created_at->format('d-m-Y') }}</td>
                                        @can('roles-status')
                                        <td>
                                            @if ($role->status == 1)
                                                <a href="{{ route('admin.roles.status', $role->id) }}"
                                                    class="btn btn-success btn-sm">Active</a>

                                            @else
                                                <a href="{{ route('admin.roles.status', $role->id) }}"
                                                    class="btn btn-danger btn-sm">Inactive</a>

                                            @endif
                                        </td>
                                        @endcan
                                        <td>
                                            @can('roles-edit')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            @can('roles-delete')
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                            <a href="{{ route('admin.roles.permission', $role->id) }}"
                                                class="btn btn-warning btn-sm">Permission</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
