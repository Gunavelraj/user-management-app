@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <div class="m-4">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h3><b>Edit User</b></h3>
            <form method="POST" action="{{ route('users.update') }}">
                {{ csrf_field() }}
                <div class="row mb-2">
                  <div class="col">
                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="first_name">First name</label>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{optional(Session::get('requestData'))['first_name']}}"  placeholder="Enter First Name"/>
                        @if ($errors->has('first_name'))
                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                  </div>
                  <div class="col">
                    <div data-mdb-input-init class="form-outline">
                      <label class="form-label" for="last_name">Last name</label>
                      <input type="text" id="last_name" name="last_name" class="form-control" value="{{optional(Session::get('requestData'))['last_name']}}" placeholder="Enter Last Name"/>
                        @if ($errors->has('last_name'))
                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                      <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="form6Example1">Role</label>
                        <select name="role" id="role" class="form-control" value="{{optional(Session::get('requestData'))['role']}}">
                            <option value="">Select Role</option>
                            <option {{ optional(Session::get('requestData'))['role'] == 'admin' ? 'selected' : ''}} value="admin">Admin</option>
                            <option {{ optional(Session::get('requestData'))['role'] == 'supervisor' ? 'selected' : ''}} value="supervisor">Supervisor</option>
                            <option {{ optional(Session::get('requestData'))['role'] == 'agent' ? 'selected' : ''}} value="agent">Agent</option>
                        </select>
                        @if ($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="col">
                      <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="Email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{optional(Session::get('requestData'))['email']}}"  placeholder="Enter Email"/>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                      </div>
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="latitude">Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" value="{{optional(Session::get('requestData'))['latitude']}}" placeholder="Enter Latitude"/>
                    @if ($errors->has('latitude'))
                        <span class="text-danger">{{ $errors->first('latitude') }}</span>
                    @endif
                    </div>
                </div>
                <div class="col">
                    <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="Email">Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="form-control"value="{{optional(Session::get('requestData'))['longitude']}}" placeholder="Enter Longitude"/>
                    @if ($errors->has('longitude'))
                        <span class="text-danger">{{ $errors->first('longitude') }}</span>
                    @endif
                    </div>
                </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{optional(Session::get('requestData'))['date_of_birth']}}" class="form-control"/>
                        @if ($errors->has('date_of_birth'))
                            <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="Email">Timezone</label>
                        <input type="text"  id="timezone" name="timezone"  class="form-control" value="{{optional(Session::get('requestData'))['timezone']}}" placeholder="Enter Timezone"/>
                        @if ($errors->has('timezone'))
                            <span class="text-danger">{{ $errors->first('timezone') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="password">New Password</label>
                            <input type="password"  id="password" name="password"  class="form-control" value="{{optional(Session::get('requestData'))['password']}}" placeholder="New Password"/>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <input type="text"  id="password" name="confirm_password"  class="form-control" value="{{optional(Session::get('requestData'))['confirm_password']}}" placeholder="Confirm Password"/>
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Submit button -->
                <a href="{{route('users.index')}}"><span class="btn btn-secondary btn-block mb-4">Cancel</span></a>
                <button type="submit" class="btn btn-success btn-block mb-4">Submit</button>
            </form>
        </div>
    </div>
@endsection
