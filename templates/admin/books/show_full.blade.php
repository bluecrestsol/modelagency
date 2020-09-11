@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')

<div class="row mb-3">
        <div class="col-6">
            <h1>{{ $data->public_name }} : Full</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @else
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @elseif (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @endif
        </div>
    </div>

    <div class="row">
    <div class="col-12 my-3"><h2>Photos</h2></div>
    @foreach($data->book_photos as $d)
    <div class="col-2">
        <img src="{{ asset('storage/uploads/photos/'.$d->filename) }}" alt="" class="img-fluid">
    </div>
    @endforeach
    </div>

    <div class="row">
    <div class="col-12 my-3"><h2>Clips</h2></div>
    @foreach($data->models_clips as $d)
    <div class="col-2">
        <video class="w-100" controls class="handle">
            <source src="{{ asset('storage/uploads/clips/models/'.$d->filename) }}">
            Your browser does not support the video tag.
        </video>
    </div>
    @endforeach
    </div>
@endsection