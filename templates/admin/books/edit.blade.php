@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')

<div class="row mb-3">
        <div class="col-6">
            <h1>{{ $data->model->public_name }} : Edit {{ $data->name }}</h1>
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

    <form action="{{ route('books.update_items', $data->uuid) }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-12 my-3"><h2>Photos</h2></div>
        @foreach($data->model->book_photos as $d)
        <div class="col-2 m-3">
            <img src="{{ asset('storage/uploads/photos/'.$d->filename) }}" alt="" class="img-fluid">
            <div class="check-holder">
                <span class="input-holder">
                    <input class="check1" type="checkbox" name="photos[]" value="{{ $d->id }}" {{ in_array($d->id, $existing_photos) ? 'checked':'' }}/>
                    <label class='logged'></label>
                </span>
                <div>Add to book</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12 my-3"><h2>Clips</h2></div>
        @foreach($data->model->models_clips as $d)
        <div class="col-2">
            <video class="w-100" controls class="handle">
                <source src="{{ asset('storage/uploads/clips/models/'.$d->filename) }}">
                Your browser does not support the video tag.
            </video>
            <div class="check-holder">
                <span class="input-holder">
                    <input class="check1" type="checkbox" name="clips[]" value="{{ $d->id }}" {{ in_array($d->id, $existing_clips) ? 'checked':'' }}/>
                    <label class='logged'></label>
                </span>
                <div>Add to book</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-secondary float-right">Cancel</button>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>
    </div>

    </form>
@endsection