@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="row mb-3">

        <div class="col-6">
            <span class="caption-subject font-dark sbold uppercase">Transaction Types</span>
        </div>
        <div class="col-6">
            <a href="{{ route('transaction_types.create') }}" class="btn btn-success float-right">Add New</a>
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
    	@include('admin.transaction_types.table')
    </div>
@endsection



