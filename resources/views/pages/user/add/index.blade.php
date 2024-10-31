@extends('layouts.app')
@section('title', 'Add User Page')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add User Form</h4>

                </div>
                <div class="card-body">

                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                            {{-- <p class="h5 text-center text-danger">Username atau password tidak sesuai!</p> --}}
                        </div>
                    @endif

                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your name" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your password" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" placeholder="Confirm your password" required />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

@endsection
