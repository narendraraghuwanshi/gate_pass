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
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <table class="table table-strpied">
                        <tr><th>Name</th><td>{{$user->name}}</td></tr>
                        <tr><th>Email</th><td>{{$user->email}}</td></tr>
                        <tr><th>Mobile Number</th><td>{{$user->mobile}}</td></tr>
                        <tr><th>Street</th><td>{{$user->street}}</td></tr>
                        <tr><th>City</th><td>{{$user->city}}</td></tr>
                        <tr><th>State</th><td>{{$user->state->stateName}}</td></tr>
                        <tr><th>Pin Code</th><td>{{$user->pinCode}}</td></tr>
                        <tr><th>Document Type</th><td>{{$user->DocumentType}}</td></tr>
                        <tr><th>Ducument Number</th><td>{{$user->documentNumber}}</td></tr>
                    </table>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@stop

@section('js')
@stop