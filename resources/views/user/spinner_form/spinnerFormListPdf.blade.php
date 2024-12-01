<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>

    <table>
        <tbody>
            <tr style="text-align: center">
                <td>
                    <h3>Pampaign Name: {{$camping->title}}</h3>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="zero_config" class="table border table-striped table-bordered text-nowrap"  style="border: 1px solid black;">
        <thead>
            <!-- start row -->
            <tr>
                <th style="border: 1px solid black ;">Sl.</th>
                <th style="border: 1px solid black ;">Date</th>
                <th style="border: 1px solid black ;">Spn Name</th>
                <th style="border: 1px solid black ;">Model</th>
                <th style="border: 1px solid black ;">Name</th>
                <th style="border: 1px solid black ;">Email</th>
                <th style="border: 1px solid black ;">Whatsapp</th>
                <th style="border: 1px solid black ;">Phone</th>
                <th style="border: 1px solid black ;">Screen </th>
                <th style="border: 1px solid black ;">IP Addr</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>

            @foreach ($SpinnerForm as $key=> $item)
                <!-- start row -->
                <tr style="border: 1px solid black ;">
                    <td style="border: 1px solid black ;">{{$key+1}}</td>
                    <td style="border: 1px solid black ;">{{$item->created_at}}</td>
                    <td style="border: 1px solid black ;">{{$item->spinner_name}}</td>
                    <td style="border: 1px solid black ;">{{$item->bike_name}}</td>
                    <td style="border: 1px solid black ;">{{$item->name}}</td>
                    <td style="border: 1px solid black ;">{{$item->email}}</td>
                    <td style="border: 1px solid black ;">{{$item->whatsapp_number}}</td>
                    <td style="border: 1px solid black ;">{{$item->phone}}</td>
                    <td style="border: 1px solid black ;">
                        <a href="{{$item->schreenshot}}" download="{{$item->name}}">Download</a>
                    </td>
                    <td  style="border: 1px solid black ;">{{$item->mac_address}}</td>
                    
                </tr>
                <!-- end row --> 
            @endforeach

            
            
        </tbody>
    </table>
          
</body>
</html>