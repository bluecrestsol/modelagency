@extends('admin.layout')
@section('content')

<div class="row mb-3">
    <div class="col-6">
        <h1>Customers</h1>
    </div>
    <div class="col-6">
        <a href="{{ route('customers.create') }}" class="btn btn-success float-right">Add New</a>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <form class="form-horizontal" id="form-search" action="{{ route('customers.index') }}">
            <div class="form-body row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="filter_name_customers" id="filter_name_customers" value="{{ Session::get('filter_name_customers') }}">
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control" name="filter_country_customers" id="filter_country_customers">
                            <option value="">Any</option>
                            @foreach($countries as $country)
                                <option value="{!! $country->id !!}" {{ (Session::get('filter_country_customers') == $country->id) ? 'selected':'' }}>{!! $country->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary float-right" id="filter_btn_customers">Filter</button>
                    <button type="reset" class="btn btn-danger float-right" onclick="window.location.href = '{{ route('customers.filter.clear') }}'">Reset</button>
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
    
    @include('admin.customers.table')
</div>
@endsection

