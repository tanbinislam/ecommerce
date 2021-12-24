<x-app-layout>
    <x-dash.page-title>View User Information</x-dash.page-title>
    <div class="row align-items-center">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ asset( $user->avatar ??  'images/placeholders/150.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                    <h4 class="mb-0 mt-2">{{$user->name}}</h4>
                    <p class="text-muted font-14 mb-3">
                        @foreach($user->roles as $role)
                            <x-dash.text-badge role="{{$role->name}}">
                                {{ $role->name }}
                            </x-dash.text-badge>
                        @endforeach
                    </p>
                    <div>
                        <a href="{{route('editUser', ['user' => $user])}}" class="btn btn-success btn-sm mb-2"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
                        <a href="{{route('editUser', ['user' => $user])}}" class="btn btn-danger btn-sm mb-2"><i class="mdi mdi-delete"></i> Delete</a>
                        <a href="{{route('allUsers')}}" class="btn btn-info btn-sm mb-2"><i class="mdi mdi-reorder-horizontal"></i> All Users</a>
                    </div>

                    <div class="mt-2 row">
                        <div class="col-3"></div>
                        <div class="col-6 text-start align-self-center">
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">Full Name :</div>
                                <div class="col-8">{{$user->name}}</div>
                            </div>
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">Email Address :</div>
                                <div class="col-8">{{$user->email}}</div>
                            </div>
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">Phone Number :</div>
                                <div class="col-8">{{$user->phone == '' ? 'N/A' : $user->phone}}</div>
                            </div>
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">User_Name :</div>
                                <div class="col-8">{{$user->user_name }}</div>
                            </div>
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">User Roles :</div>
                                <div class="col-8">
                                    @foreach($user->roles as $role)
                                    <x-dash.text-badge role="{{$role->name}}">
                                        {{ $role->name }}
                                    </x-dash.text-badge>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">Created Time:</div>
                                <div class="col-8">{{$user->created_at->toDayDateTimeString() }}</div>
                            </div>
                            <div class="row text-muted mb-2 font-16">
                                <div class="col-4">Updated Time :</div>
                                <div class="col-8">{{$user->updated_at->toDayDateTimeString() }}</div>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div> <!-- end card-body -->
            </div>
                        
        </div> <!-- end col -->
    </div><!-- end row -->
</x-app-layout>