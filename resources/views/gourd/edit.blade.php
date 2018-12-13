@extends('adminlte::page')

@section('title', 'TIT Visitor')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-md-offset-2 col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Enter Visitor Detail</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>


                    <div id="alert"></div>

                    <form action='{{route('gourd.update',$token->id)}}' method="post">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="box-body">
                        <div class="">
                            <h3>Name : {{$token->user->name}}</h3>
                            <label>Enter OTP</label>
                            <input type='number' name="otp" placeholder='654321' class='form-control input-sm' />
                        </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer text-center">
                            <a onclick="ResendOtp()" id="resend" class="btn btn-success bnt-sm">Resend OTP</a>
                            <input type="submit" class="btn btn-primary" value="Save and continue">
                        </div>
                    </form>

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@stop

@section('js')
    <script>
        function ResendOtp()
        {
            $('#resend').attr('disabled','true');
            $.get('{{route('gourd.otp',$token->id)}}',function(resp){
                if(resp.status){
                    $('#alert').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Otp Sent Successfully</div>');
                }
            })
        }
    </script>
@stop