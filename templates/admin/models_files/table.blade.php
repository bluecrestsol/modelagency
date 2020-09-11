<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Model</th>
        <th>Name</th>
        <th>Type</th>
        <th>Created At</th>
        <th style="width:180px">Actions</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
    		<td>{{ $d->model->full_name }}</td>
    		<td>{{ $d->md5 }}</td>
    		<td>{{ $d->file_type->name }}</td>
    		<td>{{ $d->created_at }}</td>
    		<td>
                <a href="{{ route('models_files.download', $d->id) }}" class="btn btn-success">Download</a>
                <a href="{{ route('models_files.show', $d->id) }}" class="btn btn-info">View</a>      
            </td>
    	</tr>
    	@endforeach
    </tbody>
</table>


@push('js')
<!-- BEGIN PAGE LEVEL SCRIPTS -->

@endpush
