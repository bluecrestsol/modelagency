<table class="table-display table table-striped" id="dataTable">
    <thead>
        <th>Name</th>
        <th>Contact Person</th>
        <th>Last Booking</th>
        <th>Last Login</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
    	@foreach($data as $d)
    	<tr>
    		<td>{{ $d->name }}</td>
    		<td>{{ $d->contact_name }}</td>
    		<td>{{ $d->last_booking }}</td>
    		<td>{{ $d->last_login }}</td>
    		<td>{!! $d->actions !!}</td>
    	</tr>
    	@endforeach
    </tbody>
</table>