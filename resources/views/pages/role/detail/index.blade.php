@extends('layouts.app')
@section('title', 'Detail Role Page')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Role Form</h4>
                </div>
                <div class="card-body">

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
                                        placeholder="Enter your name" value="{{ $d_role->name }}" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="is_active">Is Active</label>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                            disabled value="1"
                                            {{ isset($data) && $data->is_active == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">{{ isset($data) && $data->is_active == 1 ? 'Active' : 'Non Active' }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="created_date">Created date</label>
                                    <input type="text" class="form-control" id="created_date" name="created_date"
                                        disabled placeholder="Enter created date" value="{{ $d_role->created_date }}"
                                        required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="updated_date">Updated date</label>
                                    <input type="text" class="form-control" id="updated_date" name="updated_date"
                                        disabled placeholder="Enter updated date" value="{{ $d_role->updated_date }}"
                                        required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="created_by">Created by</label>
                                    <input type="text" class="form-control" id="created_by" name="created_by" disabled
                                        placeholder="Enter created by" value="{{ $d_role->created_by }}" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="updated_by">Updated by</label>
                                    <input type="text" class="form-control" id="updated_by" name="updated_by" disabled
                                        placeholder="Enter updated by" value="{{ $d_role->updated_by }}" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    @foreach ($d_list_function as $data)
                                        <div class="form-check mt-1">
                                            <input type="checkbox" class="form-check-input"
                                                id="function_{{ $data->id }}" disabled name="functions[]"
                                                value="{{ $data->id }}"
                                                {{ isset($d_role) && isset($d_role->functions) && collect($d_role->functions)->contains('id', $data->id)
                                                    ? 'checked'
                                                    : '' }}>
                                            <label class="form-check-label ms-2"
                                                for="function_{{ $data->id }}">{{ $data->name }}</label>
                                        </div>
                                    @endforeach
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