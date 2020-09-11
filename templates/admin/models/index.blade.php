@extends('admin.layout')
@section('content')


<div class="row mb-3">
        <div class="col-6">
            <h1>Models</h1>
        </div>
        <div class="col-6">
            <a href="{{ route('models.create') }}" class="btn btn-success float-right">Add New</a>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-12">
            <form class="form-horizontal" id="form-search" action="{{ route('models.index') }}">
                <div class="form-body row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="filter_name_models" id="filter_name_models" value="{{ Session::get('filter_name_models') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Agency</label>
                            <select class="form-control" name="filter_agency_models" id="filter_agency_models">
                                <option value="">Any</option>
                                @foreach($agencies as $agency)
                                    <option value="{!! $agency->id !!}" {{ (Session::get('filter_agency_models') == $agency->id) ? 'selected':'' }}>{!! $agency->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="filter_country_models" id="filter_country_models">
                                <option value="">Any</option>
                                @foreach($countries as $country)
                                    <option value="{!! $country->id !!}" {{ (Session::get('filter_country_models') == $country->id) ? 'selected':'' }}>{!! $country->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Sex</label>
                            <select class="form-control" name="filter_sex_models" id="filter_sex_models">
                                <option value="">Any</option>
                                @foreach(config('constants.models.sex') as $key => $value)
                                    <option value="{!! $key !!}" {{ (Session::get('filter_sex_models') == $key) ? 'selected':'' }}>{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="filter_status_models" id="filter_status_models">
                                @foreach(config('constants.models.status') as $key => $value)
                                    <option value="{!! $key !!}" {{ (Session::get('filter_status_models') !== null && Session::get('filter_status_models') == $key) ? 'selected':'' }}>{!! $value !!}</option>
                                @endforeach
                                <option value="">Any</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-right" id="filter_btn_models">Filter</button>
                        <button type="reset" class="btn btn-danger float-right" onclick="window.location.href = '{{ route('models.filter.clear') }}'">Reset</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

    <div class="row">
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
        
        @include('admin.models.table')
    </div>
@endsection

