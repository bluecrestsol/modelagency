<table class="table table-striped table-bordered table-hover table-condensed" id="dataTable">
    <thead>
    <!-- Happened At | Model | Type | Admin | Amount | Actions -->
        <th>Happened At</th>
        <th>Model</th>
        <th>Type</th>
        <th>Admin</th>
        <th>Amount</th>
        <th style="width:180px">Actions</th>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->happened_at }}</td>
            <td>{{ $d->model ? $d->model->search_name:$d->model_id }}</td>
            <td>{{ $d->transaction_type }}</td>
            <td>{{ $d->admin->full_name }}</td>
            <td>{{ $d->amount }}</td>
            <td>{!! $d->actions !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>