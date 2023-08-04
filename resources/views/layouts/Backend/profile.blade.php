@extends('include.BackendIncluder')

@section('mainContent')

            <!-- BEGIN: Profile  -->
            <div class="profile mt-5">
                <div class="row">
                    <div class="card col-lg-7">
                        <div class="intro-y d-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                Profile info.
                            </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.info.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="text" placeholder="Name" value="{{ auth()->user()->name }}" class="form-control p-3" name="name">
                                @error('name')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="email" placeholder="Email" value="{{ auth()->user()->email }}" class="form-control mt-3 p-3" name="email">
                                @error('email')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="tel" placeholder="phone number" class="form-control mt-3 p-3" name="phone">
                                @error('phone')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="file" class="form-control mt-3 p-3" name="profile_img">
                                @error('profile_img')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-primary mt-3 d-block" type="submit">update changes</button>
                            </form>
                        </div>
                    </div>
                    <div class="card p-3 col-lg-5">
                        <div class="intro-y d-flex align-items-center h-10">
                            <h2 class="fs-lg fw-medium truncate me-5">
                                Password
                            </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.password.update') }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="password" value="{{ old('old_password') }}" placeholder="old password" class="form-control p-3" name="old_password">
                                @error('old_password')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="password" placeholder="new password" class="form-control mt-3 p-3" name="password">
                                @error('password')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="password" placeholder="confirm password" class="form-control mt-3 p-3" name="password_confirmation">
                                @error('old_password')
                                    <span class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-primary mt-3" type="submit">update password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Profile -->
    </div>
    <!-- END: Content -->
@endsection
