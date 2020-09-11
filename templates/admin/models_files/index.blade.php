@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="portlet-title">

        <div class="caption">
            <i class="icon-users font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">Models Files</span>
        </div>
        <div class="actions">
            <a href="{{ route('models_files.create') }}" class="btn btn-success pull-right">Add New</a>
        </div>
        <div class="clearfix"></div>

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
    	@include('admin.models_files.table')
    </div>
@endsection

