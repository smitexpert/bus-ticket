@extends('admin.layout.main')
@section('content')
@include('admin.partial.alert')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Update Account Information</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.profile.info.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" value="{{ $profile->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" value="{{ $profile->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" value="{{ $profile->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Current Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Update Account Password</h4>
                </div>
                <div class="panel-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="password">Current Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Current Password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" placeholder="Enter New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password-cofirm">Confirm Password</label>
                            <input type="password" class="form-control" id="password-cofirm" name="password_confirm" placeholder="Confirm New Password" required>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
