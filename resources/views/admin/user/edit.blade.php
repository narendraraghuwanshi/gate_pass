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
                    <h3 class="box-title">Enter Visitor Detail</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                    <form action='{{route('user.update',$user->id)}}' method="post" autocomplete="off">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="box-body">
                        <div class="">
                            <label>Enter Mobile Number</label>
                            <input onblur="CheckUser(this.value)" type='number' name="mobile" value="{{$user->mobile}}" placeholder='9876543210' readonly class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>First Name</label>
                            <input id="firstName" type='text' name="firstName" value="{{$user->firstName}}" placeholder='John' class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>Last Name</label>
                            <input id="lastName" type='text' name="lastName" value="{{$user->lastName}}" placeholder='Doy' class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>Email Id</label>
                            <input id="email" type='email' name="email" value="{{$user->email}}" placeholder='tit@gmail.com' readonly class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>Street</label>
                            <input id="street" type='text' name="street" value="{{$user->street}}" placeholder='Anand Nagar' class='form-control input-sm' />
                        </div>
                            <div class="">
                                <label>User Role</label>
                                <select id="role" class="form-control js-example-basic-multiple" name="role[]" multiple="multiple" required>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{ $user->hasRole($role->name)? 'selected' : '' }}>{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="col-md-4">
                            <label>City</label>
                            <input id="city" type='text' name="city" value="{{$user->city}}" placeholder='Bhopal' class='form-control input-sm' />
                        </div>
                        <div class="col-md-4">
                            <label>State</label>
                            <select id="stateId" class="form-control select2" name="stateId">
                                <option selected disabled="">Select State</option>
                                @foreach($states as $state)
                                <option value="{{$state->id}}" {{ $user->stateId === $state->id? 'selected' : '' }} >{{$state->stateName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Pin Code</label>
                            <input id="pinCode" type='number' name="pinCode" value="{{$user->pinCode}}" placeholder='462021' maxlength="6" class='form-control input-sm' />
                        </div>
                        <div class="col-md-6">
                            <label>Document Type</label>
                            <select id="DocumentType" name="DocumentType" class="form-control select2" >
                                <option selected disabled="">Select Document</option>
                                <option value="Adhar Card" @if ($user->DocumentType == "Adhar Card")selected="selected" @endif>Adhar Card</option>
                                <option value="Voter Card" @if ($user->DocumentType == "Voter Card")selected="selected" @endif>Voter Card</option>
                                <option value="Pan Card" @if ($user->DocumentType == "Pan Card")selected="selected" @endif>Pan Card</option>
                                <option value="Driving Licence" @if ($user->DocumentType == "Driving Licence")selected="selected" @endif>Driving Licence</option>
                                <option value="Ration Card" @if ($user->DocumentType == "Ration Card")selected="selected" @endif>Ration Card</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Enter Document NUmber</label>
                            <input id="documentNumber" type='text' name="documentNumber" value="{{$user->documentNumber}}" placeholder='9876543210' class='form-control input-sm' />
                        </div>
                       </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@stop
@section('js')
    <script>
            $('.js-example-basic-multiple').select2();
    </script>

@stop
