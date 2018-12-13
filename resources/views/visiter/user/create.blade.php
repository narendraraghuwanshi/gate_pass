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
                    <form action='{{route('user.store')}}' method="post" autocomplete="off">
                        @csrf
                        <div class="box-body">
                        <div class="">
                            <label>Enter Mobile Number</label>
                            <input onblur="CheckUser(this.value)" type='number' name="mobile" placeholder='9876543210' class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>First Name</label>
                            <input id="firstName" type='text' name="firstName" placeholder='John' class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>Last Name</label>
                            <input id="lastName" type='text' name="lastName" placeholder='Doy' class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>Email Id</label>
                            <input id="email" type='email' name="email" placeholder='tit@gmail.com' class='form-control input-sm' />
                        </div>
                        <div class="">
                            <label>Street</label>
                            <input id="street" type='text' name="street" placeholder='Anand Nagar' class='form-control input-sm' />
                        </div>
                        <div class="col-md-4">
                            <label>City</label>
                            <input id="city" type='text' name="city" placeholder='Bhopal' class='form-control input-sm' />
                        </div>
                        <div class="col-md-4">
                            <label>State</label>
                            <select id="stateId" class="form-control select2" name="stateId">
                                <option selected disabled="">Select State</option>
                                @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->stateName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Pin Code</label>
                            <input id="pinCode" type='number' name="pinCode" placeholder='462021' maxlength="6" class='form-control input-sm' />
                        </div>
                        <div class="col-md-6">
                            <label>Document Type</label>
                            <select id="DocumentType" name="DocumentType" class="form-control select2" >
                                <option selected disabled="">Select Document</option>
                                <option value="Adhar Card">Adhar Card</option>
                                <option value="Voter Card">Voter Card</option>
                                <option value="Pan Card">Pan Card</option>
                                <option value="Driving Licence">Driving Licence</option>
                                <option value="Ration Card">Ration Card</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Enter Document NUmber</label>
                            <input id="documentNumber" type='text' name="documentNumber" placeholder='9876543210' class='form-control input-sm' />
                        </div>
                       </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->

@stop
@section('js')

@stop
