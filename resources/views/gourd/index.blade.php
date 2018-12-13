@extends('adminlte::page')

@section('title', 'TIT Visitor')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools pull-right">
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
                                <th>Approval</th>
                                <th>Updated At</th>
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
            ajax: '{!! route('gourd.index') !!}',
          columns: [
              { data: 'id', name: 'tokens.id' },
              { data: 'name', name: 'users.name' },
              { data: 'mobile', name: 'users.mobile' },
              { data: 'isApprove', name: 'tokens.isApprove' },
              { data: 'updated_at', name: 'tokens.updated_at' }
          ]
        });
      setInterval( function () {
          console.log('Refress');
          table.ajax.reload();
      }, 9000 );
    </script>
@stop