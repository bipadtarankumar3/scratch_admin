
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<table id="zero_config"
                        class="table border table-striped table-bordered text-nowrap"  style="border: 1px solid black ;">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th  style="border: 1px solid black ;">Sl.</th>
                                <th  style="border: 1px solid black ;">Campaign name</th>
                                <th  style="border: 1px solid black ;">Title</th>
                                <th  style="border: 1px solid black ;">Sub Title</th>
                                <th  style="border: 1px solid black ;">Start Date</th>
                                <th  style="border: 1px solid black ;">End Date</th>
                                <th  style="border: 1px solid black ;">Total Form</th>
                                <th  style="border: 1px solid black ;">Speed Time</th>
                                <th  style="border: 1px solid black ;">Status</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($camping as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td  style="border: 1px solid black ;">{{$key+1}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->campaign_name}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->title}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->sub_title}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->start_date}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->end_date}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->total_form}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->spinner_time}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->status}}</td>
                                    
                                </tr>
                                <!-- end row --> 
                            @endforeach

                            
                            
                        </tbody>
                    </table>
</body>
</html>
