<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Feature</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
		<td>{{ $d->name }}</td>
    		<td><a href="{{ route('features.show-feature', ['id' => $d->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Show</a></td>
    	</tr>
    	@endforeach
    </tbody>
</table>

