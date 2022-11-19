

@php
    print_r($data);
    exit();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('pdf/css/pdf.css') }}">
</head>

<body>
    <table class="blueTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                {{-- <th>Total Input</th> --}}
            </tr>
        </thead>
        {{-- <tbody>

            @php
                $index = 1;
                
            @endphp
            @foreach ($data as $item)

                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $item->date }}</td>
                </tr>
                @php
                    $index++;
                @endphp
            @endforeach

        </tbody> --}}
    </table>
</body>

</html>
