<x-app-layout>
    <x-dash.page-title>Deleted Users</x-dash.page-title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('success')}}
                                </div>
                            @endif
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('addUser') }}" class="btn btn-info mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add User</a>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-striped dt-responsive nowrap w-100" id="all-datatable">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>Delete Date</th>
                                    <th>Role</th>
                                    <th style="width: 75px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedUsers as $user)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $user->user_name }}">
                                            <label class="form-check-label" for="{{ $user->user_name }}">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="table-user">
                                        <img src="{{ asset( $user->avatar ??  'images/placeholders/150.png') }}" alt="table-user" class="me-2 rounded-circle">
                                        <a href="{{route('viewUser', ['user' => $user])}}" class="text-body fw-semibold">{{$user->name}}</a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->deleted_at->toFormattedDateString(); }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <x-dash.text-badge role="{{$role->name}}">
                                                {{ $role->name }}
                                            </x-dash.text-badge>
                                        @endforeach
                                    </td>

                                    <td>
                                        <a data-name="User" data-title="{{$user->name}}" href="#" data-url="{{route('restoreUser', ['id' => $user->id])}}" class="dtbl-icon action-icon restore-dta" title="Restore"> <i class="mdi mdi-restore"></i></a>
                                        <a data-name="User" data-title="{{$user->name}}" href="#" data-url="{{route('permanentDeleteUser', ['id' => $user->id])}}" class="dtbl-icon action-icon permanent-delete-dta" title="Permanent Delete"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form id="restore-form" action="" method="post">
                            @csrf
                            <input style="display: none" type="submit" value="submit">
                        </form>

                        <form id="permanent-delete-form" action="" method="post">
                            @csrf
                            <input style="display: none" type="submit" value="submit">
                        </form>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div><!-- end row -->
</x-app-layout>