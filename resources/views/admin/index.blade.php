<!-- resources/views/admin/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Details</title>
</head>
<body>
    <h1>Loan Details</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    
    <table border="1">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Loan Amount</th>
                <th>Number of Payments</th>
                <th>First Payment Date</th>
                <th>Last Payment Date</th>
                <!-- Add other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($loanDetails as $loanDetail)
                <tr>
                    <td>{{ $loanDetail->clientid }}</td>
                    <td>{{ $loanDetail->loan_amount }}</td>
                    <td>{{ $loanDetail->num_of_payment }}</td>
                    <td>{{ $loanDetail->first_payment_date }}</td>
                    <td>{{ $loanDetail->last_payment_date }}</td>
                    <!-- Add other columns as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
