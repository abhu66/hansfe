@extends('layouts.app')
@section('title', 'Upload Page')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Upload Excell File</h4>
                    <div class="flex-shrink-0">
                        <a href="#" class="btn btn-primary" id="addUserButton" data-bs-toggle="modal" data-bs-target="#uploadCsvModal">
                            <i class="ri-add-line align-middle"></i> Add File
                        </a>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <p class="text-muted">Use <code>table</code> class to show bootstrap-based default table.</p>
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Filename</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created by</th>
                                        <th scope="col">Created date</th>
                                        <th scope="col">Updated by</th>
                                        <th scope="col">Updated date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>pret</td>
                                        <td>pret</td>
                                        <td>pret</td>
                                        <td>pret</td>
                                        <td>pret</td>
                                        <td>pret</td>
                                        <td>pret</td>
                                        <td>pret</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- Modal for Upload CSV -->
    <div class="modal fade" id="uploadCsvModal" tabindex="-1" aria-labelledby="uploadCsvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadCsvModalLabel">Upload CSV File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">Select CSV File</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
