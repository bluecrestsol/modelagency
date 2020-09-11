@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="row mb-3">

        <div class="col">
            <h1>Jobs</h1>
        </div>
        <div class="col">
            <a href="{{ route('jobs.create') }}" class="btn btn-success float-right">Add New</a>
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
    	@include('admin.jobs.table')
    </div>
@endsection


