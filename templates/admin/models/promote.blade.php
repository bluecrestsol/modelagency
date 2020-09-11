@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')
 
<div class="row mb-3">
        <div class="col-6">
            <h1>PROMOTE MODEL {{ $data->full_name }}</h1>
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
        
        <div>
        <form action="{{ route('models.promote.submit') }}" method="POST">
            <button type="submit" class="btn btn-success float-right">Submit</button>
            {{ csrf_field() }}
            <input type="hidden" value="{{ $data->uuid }}" name="model_uuid">
            <select class="image-picker" data-limit="5" multiple="multiple" name="images[]">
                @foreach($data->book_photos as $i)
                <option data-img-src="{{ asset('storage/uploads/photos/'.$i->filename) }}" value="{{ asset('storage/uploads/photos/'.$i->filename) }}">{{ $i->filename }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-success float-right">Submit</button>
        </form>

        </div>
    </div>
    
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/image-picker/image-picker/image-picker.css') }}">
<style>
    ul.thumbnails.image_picker_selector li {
        max-width: 200px;
    }

    .image_picker_image {
        width: 100%;
    }
</style>
@endpush
@push('js')
<script src="{{ asset('plugins/image-picker/image-picker/image-picker.js') }}"></script>
<script>
    $(".image-picker").imagepicker({limit: 5})
</script>
@endpush