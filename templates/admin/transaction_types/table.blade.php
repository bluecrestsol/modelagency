<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
        <th>Name</th>
        <th>Type</th>
        <th style="width:180px">Action</th>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->name }}</td>
            <td>{{ $d->type }}</td>
            <td>{!! $d->actions !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>