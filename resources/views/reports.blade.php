<table>
    <thead>
        <tr>
            <th>Email</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Models\Landing::get() as $value)
            <tr>
                <td>{{ $value->email  }}</td>
                <td>{{ $value->created_at  }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
