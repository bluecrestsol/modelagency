@extends('admin.layout')
@section('content')

<div class="row mb-3">
    <div class="col-6">
        <h1>Agencies</h1>
    </div>
    <div class="col-6">
        <a href="{{ route('agencies.create') }}" class="btn btn-success float-right">Add New</a>
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
    
    @include('admin.agencies.table')
</div>
@endsection
