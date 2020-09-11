@extends('admin.layout')
@section('title', ucfirst(Request::segment(2)))
@section('content')

<div class="row mb-3">
        <div class="col-6">
            <h1>{{ $data->model->public_name }} : {{ $data->name }}</h1>
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
    @foreach($data->images as $d)
    <div class="col-2">
        <img src="{{ asset('storage/uploads/photos/'.$d->image->filename) }}" alt="" class="img-fluid">
    </div>
    @endforeach
    </div>

    <div class="row">
    <div class="col-12 my-3"><h2>Clips</h2></div>
    @foreach($data->clips as $d)
    <div class="col-2">
        <video class="w-100" controls class="handle">
            <source src="{{ asset('storage/uploads/clips/models/'.$d->clip->filename) }}">
            Your browser does not support the video tag.
        </video>
    </div>
    @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <a href="javascript:;" data-url="{{ route('books.destroy', $data->id) }}" onclick="deleteBook(this)" class="btn btn-danger float-right">Delete</a>
            <a href="{{ route('books.edit', $data->uuid) }}" class="btn btn-primary float-right">{{ $data->clips->count() || $data->images->count() ? 'Edit' : 'Add' }}</a>
        </div>
    </div>
@endsection

@push('js')
<script>
    function deleteBook(self) {
        var url = $(self).data('url');
        bootbox.confirm({
        message: 'Are you sure you want to delete this book?',
        buttons:{
          confirm: {
            label: 'Yes',
            className: 'btn-danger'
          },
          cancel: {
            label: 'No',
            className: 'btn-default'
          },
        },
        callback: function(result){
          if(result) {
            $.ajax({
              url:url,
              type:'DELETE',
              success: function(r) {
                // r = JSON.parse(r);
                window.location.href = r.redirect;
              },
            });
          }
        },
      });
    }
</script>
@endpush