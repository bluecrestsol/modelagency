<table class="table-display table table-striped" id="dataTable">
    <thead>
        <th>Name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Line</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
        
    	@foreach($data as $d)
    	<tr>
            <td>{{ $d->title_desc . ' ' . $d->complete_name }}</td>
    		<td>{{ config("constants.admins.roles.{$d->role}") }}</td>
            <td>{{ $d->status_desc }}</td>
    		<td>{{ $d->email }}</td>
            <td>{{ $d->mobile }}</td>
    		<td>{{ $d->line }}</td>
    		<td>
                <a href="{{ route('admins.show', $d->id) }}" class="btn btn-info btn-xs">Show</a>      
            </td>
    	</tr>
    	@endforeach

    </tbody>
</table>