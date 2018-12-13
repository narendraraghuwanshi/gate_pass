@extends('adminlte::page')

@section('title', 'TIT Visitor')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class='row'>
        <div class=' col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Visitor Detail</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div id="alert"></div>
                <form action='{{route('token.update',$token->id)}}' method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="box-body">
                        <div class="">
                            <table class="table table-bordered">
                                <tr><th>Name</th><td>{{$token->user->name}}</td></tr>
                                <tr><th>Email</th><td>{{$token->user->email}}</td></tr>
                                <tr><th>Mobile Number</th><td>{{$token->user->mobile}}</td></tr>
                                <tr><th>Street</th><td>{{$token->user->street}}</td></tr>
                                <tr><th>City</th><td>{{$token->user->city}}</td></tr>
                                <tr><th>State</th><td>{{$token->user->state->stateName}}</td></tr>
                                <tr><th>Pin Code</th><td>{{$token->user->pinCode}}</td></tr>
                                <tr><th>Document Type</th><td>{{$token->user->DocumentType}}</td></tr>
                                <tr><th>Ducument Number</th><td>{{$token->user->documentNumber}}</td></tr>

                            </table>

                            <div class="page-header">
                                <h1><small class="pull-right">{{$token->comments->count()}} comments</small> Comments </h1>
                            </div>
                            <div class="comments-list">
                                @foreach($token->comments->reverse() as $comment)
                                    <div class="media">
                                        <p class="pull-right"><small>{{$comment->created_at->diffForHumans()}}</small></p>
                                        <div class="media-body">
                                            <h4 class="media-heading user_name">{{$comment->user->name}}</h4>
                                            {!! $comment->comment !!}<hr/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <label>Enter Comment</label>
                            <textarea  name="comment" placeholder='Enter message' class='form-control input-sm' required></textarea>
                        </div>




                    </div><!-- /.box-body -->

                    <div class="box-footer text-center">
                        <input type="submit" name="act" class="btn btn-success" value="Save and Back">
                        <input type="submit" name="act" class="btn btn-primary" value="Save and continue">
                    </div>
                </form>

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@stop

@section('js')
   {{-- <script>
        function ResendOtp()
        {
            $('#resend').attr('disabled','true');
            $.get('{{route('gourd.otp',$token->id)}}',function(resp){
                if(resp.status){
                    $('#alert').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Otp Sent Successfully</div>');
                }
            })
        }
    </script>--}}
@stop