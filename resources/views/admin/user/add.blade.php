<x-app-layout>
    <x-dash.page-title>Add Users</x-dash.page-title>
    <div class="row align-items-center">
        <div class="col-12">                      
        <form class="form-horizontal" method="post" action="{{ route('createUser') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header card_header">
                    <div class="row">
                        <div class="col-md-8 card_header_title">
                        <i class="mdi mdi-contactless-payment-circle"></i> User Registration
                        </div>
                        <div class="col-md-4 card_button_part">
                        <a class="btn btn-md btn-dark" href="{{ route('allUsers') }}"><i class="mdi mdi-reorder-horizontal me-1"></i> <span>All User</span> </a>
                        </div>
                    </div>
                </div>
                <div class="card-body card_body">
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Phone:</label>
                        <div class="col-8">
                            <input type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{old('phone')}}">
                            <div class="row">
                                <div class="col-6">
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                     @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-text text-info float-right">
                                        <strong>( Exclude +88 or 088 | example: 01700000000 )</strong>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label">Confirm-Password<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-2 col-form-label">User Role<span class="req_star">*</span>:</label>
                        <div class="col-8">
                            @foreach (\Spatie\Permission\Models\Role::all() as $role)
                            <div class="form-check form-checkbox-success mb-2">
                                <input value="{{ $role->name }}" name="role[]" type="checkbox" class="form-check-input" id="{{'role-'.Str::slug($role->name, '-')}}" {{$role->name == 'Customer' ? 'checked' : ''}}>
                                <label class="form-check-label" for="{{'role-'.Str::slug($role->name, '-')}}">{{$role->name}}</label>
                                @if ($role->name == 'Customer')
                                    <span class="form-text text-info"><strong>( Default role of user. )</strong></span>
                                @endif 
                            </div>
                            @endforeach
                            @if ($errors->has('role'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif  
                        </div>
                    </div>
                </div>
                <div class="card-footer card_footer text-center">
                    <button type="submit" class="btn btn-md btn-dark">SUBMIT</button>
                </div>
            </div>
            </form>    
        </div> <!-- end col -->
    </div><!-- end row -->
</x-app-layout>