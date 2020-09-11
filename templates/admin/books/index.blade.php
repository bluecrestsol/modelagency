@extends('admin.layout')
@section('content')

<div class="row mb-3">
    <div class="col-6">
        <h1>Books</h1>
    </div>
    <div class="col-6">
        <button class="btn btn-success float-right" data-toggle="modal" data-target="#newBookModal">New Book</button>
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
        @endif
    @endif
    
    @include('admin.books.table')
    </div>
    
</div>

<!-- MODAL NEW BOOK-->
<div class="modal fade" tabindex="-1" role="dialog" id="newBookModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('books.store') }}" method="POST">
            <input type="hidden" name="model_id" value="{{ $data->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success float-right">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END NEW BOOK MODAL -->
@endsection


