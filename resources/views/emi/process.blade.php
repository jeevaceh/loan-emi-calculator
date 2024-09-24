<!DOCTYPE html>
<html>
<head>
    <title>EMI Details</title>
</head>
<body>
    <h1>EMI Details</h1>

    <!-- Form to process data -->
    <form action="{{ route('emi.process') }}" method="POST">
        @csrf
        <button type="submit">Process Data</button>
    </form>

    @if (session('success'))
        <h2>EMI Details Table</h2>
        
        @if(!empty($emiDetails) && count($emiDetails) > 0)
            <table border="1">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <!-- Dynamically generate headers from the first EMI detail row -->
                        @foreach(array_keys((array)$emiDetails[0]) as $key)
                            @if($key != 'clientid') <!-- Exclude 'clientid' from the dynamic headers -->
                                <th>{{ $key }}</th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emiDetails as $emiDetail)
                        <tr>
                            <td>{{ $emiDetail->clientid }}</td>
                            @foreach($emiDetail as $key => $value)
                                @if($key != 'clientid')
                                    <td>{{ $value ?? '0.00' }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No EMI data available.</p>
        @endif
    @else
        <h2>No EMI data processed yet. Please click "Process Data".</h2>
    @endif

</body>
</html>
