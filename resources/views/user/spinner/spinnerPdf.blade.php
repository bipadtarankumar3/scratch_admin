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
                                <th  style="border: 1px solid black ;">Campaign  Name</th>
                                <th  style="border: 1px solid black ;">Name</th>
                                <th  style="border: 1px solid black ;">Color</th>
                                <th  style="border: 1px solid black ;">Skip</th>
                                <th  style="border: 1px solid black ;">Status</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($Spinner as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td  style="border: 1px solid black ;">{{$key+1}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->c_name}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->name}}</td>
                                    <td  style="border: 1px solid black ;"> <div style="height: 60px;width:90px;background:{{$item->color}}" ></div> </td>
                                    <td  style="border: 1px solid black ;">{{$item->skip}}</td>
                                    <td  style="border: 1px solid black ;">{{$item->status}}</td>
                                    
                                </tr>
                                <!-- end row --> 
                            @endforeach

                            
                            
                        </tbody>
                    </table>
</body>
</html>

