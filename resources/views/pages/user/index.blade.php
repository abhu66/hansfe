@extends('layouts.app')
@section('title', 'List Users Page')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Table Users</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('user.create') }}" class="btn btn-primary" id="addUserButton">
                            <i class="ri-add-line align-middle"></i> Add User
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
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Updated at</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $data)
                                        <tr>
                                            <th scope="row"><a href="#" class="fw-medium">{{ $data->id }}</a>
                                            </th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i') : '-' }}
                                            </td>
                                            <td>
                                                {{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d-m-Y H:i') : '-' }}
                                            </td>
                                            <td>{{ $data->role->name }}</td>
                                            <td><a href="javascript:void(0);" class="link-success">View More <i
                                                        class="ri-arrow-right-line align-middle"></i></a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-none code-view">
                        <pre class="language-markup" style="height: 275px;"><code>&lt;table class=&quot;table table-nowrap&quot;&gt;
&lt;thead&gt;
&lt;tr&gt;
&lt;th scope=&quot;col&quot;&gt;ID&lt;/th&gt;
&lt;th scope=&quot;col&quot;&gt;Customer&lt;/th&gt;
&lt;th scope=&quot;col&quot;&gt;Date&lt;/th&gt;
&lt;th scope=&quot;col&quot;&gt;Invoice&lt;/th&gt;
&lt;th scope=&quot;col&quot;&gt;Action&lt;/th&gt;
&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;th scope=&quot;row&quot;&gt;&lt;a href=&quot;#&quot; class=&quot;fw-semibold&quot;&gt;#VZ2110&lt;/a&gt;&lt;/th&gt;
&lt;td&gt;Bobby Davis&lt;/td&gt;
&lt;td&gt;October 15, 2021&lt;/td&gt;
&lt;td&gt;$2,300&lt;/td&gt;
&lt;td&gt;&lt;a href=&quot;javascript:void(0);&quot; class=&quot;link-success&quot;&gt;View More &lt;i class=&quot;ri-arrow-right-line align-middle&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;th scope=&quot;row&quot;&gt;&lt;a href=&quot;#&quot; class=&quot;fw-semibold&quot;&gt;#VZ2109&lt;/a&gt;&lt;/th&gt;
&lt;td&gt;Christopher Neal&lt;/td&gt;
&lt;td&gt;October 7, 2021&lt;/td&gt;
&lt;td&gt;$5,500&lt;/td&gt;
&lt;td&gt;&lt;a href=&quot;javascript:void(0);&quot; class=&quot;link-success&quot;&gt;View More &lt;i class=&quot;ri-arrow-right-line align-middle&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;th scope=&quot;row&quot;&gt;&lt;a href=&quot;#&quot; class=&quot;fw-semibold&quot;&gt;#VZ2108&lt;/a&gt;&lt;/th&gt;
&lt;td&gt;Monkey Karry&lt;/td&gt;
&lt;td&gt;October 5, 2021&lt;/td&gt;
&lt;td&gt;$2,420&lt;/td&gt;
&lt;td&gt;&lt;a href=&quot;javascript:void(0);&quot; class=&quot;link-success&quot;&gt;View More &lt;i class=&quot;ri-arrow-right-line align-middle&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;th scope=&quot;row&quot;&gt;&lt;a href=&quot;#&quot; class=&quot;fw-semibold&quot;&gt;#VZ2107&lt;/a&gt;&lt;/th&gt;
&lt;td&gt;James White&lt;/td&gt;
&lt;td&gt;October 2, 2021&lt;/td&gt;
&lt;td&gt;$7,452&lt;/td&gt;
&lt;td&gt;&lt;a href=&quot;javascript:void(0);&quot; class=&quot;link-success&quot;&gt;View More &lt;i class=&quot;ri-arrow-right-line align-middle&quot;&gt;&lt;/i&gt;&lt;/a&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
