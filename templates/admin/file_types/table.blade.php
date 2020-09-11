<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Name</th>
        <th>Owner</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
    		<td>{{ $d->name }}</td>
    		<td>{{ $d->owner }}</td>
    		<td><a href="{{ route('file_types.show', ['id' => $d->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Show</a></td>
    	</tr>
    	@endforeach
    </tbody>
</table>

