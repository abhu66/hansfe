@extends('layouts.app')
@section('title', 'Detail User Page')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail User Form</h4>
                </div>
                <div class="card-body">

                    {{-- Menampilkan pesan kesalahan validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger justify-content-start align-items-center" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <form>
                        @csrf
                        <div class="row g-3">

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" disabled
                                        placeholder="Enter your name" value="{{ $d_user->name }}" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" disabled
                                        placeholder="Enter your email" value="{{ $d_user->email }}" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" disabled
                                        placeholder="Enter your password" value="********" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="role">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" disabled
                                        value="{{ $d_user->role }}" required />
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
