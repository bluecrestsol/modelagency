@extends('admin.layout')
@section('content')
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light portlet-fit portlet-datatable ">

    <div class="portlet-title">

        <div class="row mb-3">
            <div class="col-6">
                <h1>File Types</h1>
            </div>

            <div class="col-6">
                <a href="{{ route('file_types.create') }}" class="btn btn-success float-right">Add New</a>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-12">
                <form class="form-horizontal" id="form-search" action="{{ route('file_types.index') }}">
                    <div class="form-body">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Owner</label>
                                <select class="form-control" name="filter_owner_file_types" id="filter_owner_file_types">
                                    <option value="">Any</option>
                                    @foreach(config('constants.file_types.owner_types') as $key => $value)
                                        <option value="{!! $key !!}" {{ (Session::get('filter_owner_file_types') == $key) ? 'selected':'' }}>{!! ucfirst($value) !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right" id="filter_btn_file_types">Filter</button>
                            <button type="reset" class="btn btn-danger float-right" onclick="window.location.href = '{{ route('file_types.filter.clear') }}'">Reset</button>
                        </div>
                    </div>
                    
                </form>
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
    	@include('admin.file_types.table')
    </div>
@endsection


