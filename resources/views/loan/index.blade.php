<!DOCTYPE html>
<html>
<head>
    <title>Loan Details</title>
</head>
<body>
    <h1>Loan Details</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Loan Amount</th>
                <th>Number of Payments</th>
                <th>First Payment Date</th>
                <th>Last Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loanDetails as $loan)
                <tr>
                    <td>{{ $loan->clientid }}</td>
                    <td>{{ $loan->loan_amount }}</td>
                    <td>{{ $loan->num_of_payment }}</td>
                    <td>{{ $loan->first_payment_date }}</td>
                    <td>{{ $loan->last_payment_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
