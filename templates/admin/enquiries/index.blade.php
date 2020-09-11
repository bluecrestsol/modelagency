@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="row mb-3">

        <div class="col">
            <h1>Enquiries</h1>
        </div>
    </div>


    <div class="portlet-body">
    	@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @elseif(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
    	

        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
            <thead>
                <th>Created At</th>
                <th>Model</th>
                <th>From</th>
                <th>Country</th>
                <th style="width:180px">Actions</th>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{ $d->created_at }}</td>
                    <td>{{ $d->model->full_name }}</td>
                    <td>{{ $d->from_name }} ({{ $d->from_company }})</td>
                    <td>{{ $d->country->name }}</td>
                    <td>
                        <a href="{{ route('enquiries.show', $d->id) }}" class="btn btn-primary btn-xs">Show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

