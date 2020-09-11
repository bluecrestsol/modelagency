@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="portlet-title">

        <div class="row mb-3">
            <div class="col-6">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('models.files.create', ['id' => $data->id]) }}" class="btn btn-success float-right">Add New</a>
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
        
        <table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
            <thead>
                <th>Name</th>
                <th>Type</th>
                <th>Created At</th>
                <th style="width:180px">Actions</th>
            </thead>
            <tbody>
                @foreach($data->fileList as $d)
                <tr>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->file_type->name }}</td>
                    <td>{{ $d->created_at }}</td>
                    <td>
                        <a href="{{ route('files.download', ['id' => $d->id]) }}" class="btn btn-success">Download</a>
                        <a href="{{ route('files.edit', ['id' => $d->id]) }}" class="btn btn-info">View</a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection

