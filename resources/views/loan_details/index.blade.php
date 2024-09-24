<table>
    <thead>
        <tr>
            <th>Client ID</th>
            <th>Number of Payments</th>
            <th>First Payment Date</th>
            <th>Last Payment Date</th>
            <th>Loan Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->clientid }}</td>
            <td>{{ $loan->num_of_payment }}</td>
            <td>{{ $loan->first_payment_date }}</td>
            <td>{{ $loan->last_payment_date }}</td>
            <td>{{ $loan->loan_amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('process-data') }}" method="POST">
    @csrf
    <button type="submit">Process Data</button>
</form>
