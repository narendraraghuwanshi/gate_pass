@extends('adminlte::page')

@section('title', 'Admin - User')

@section('content_header')
    <h1>User</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User List</h3>
                    <div class="box-tools pull-right">
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Create</a>
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Option</th>
                        </tr>
                        </thead>

                    </table>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@stop

@section('js')
    <script>
        var table =  $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('user.index') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'mobile' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role',search:false },
                { data: 'option', name: 'option',search:false }
            ]
        });

    </script>
@stop