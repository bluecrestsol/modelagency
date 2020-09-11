@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="portlet-title">

        <div class="row mb-3">
            <div class="col-6">
                <h1>Transactions</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('transactions.create', ['type' => 2]) }}" class="btn btn-warning float-right"><i class="fa fa-plus"></i> New Expense</a>
                <a href="{{ route('transactions.create', ['type' => 1]) }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> New Booking</a>
            </div>
        </div>
    </div>


    <div class="portlet-body">
    	@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @else
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        @endif
    	@include('admin.transactions.table')
    </div>
@endsection

