@extends('adminLayouts.home')
@section('content')


<div class="container-fluid">
<!-- basic table -->
<div class="row">
    <div class="col-12">
        <!-- ---------------------
                start Zero Configuration
            ---------------- -->
        <div class="card">
            <div class="card-header">
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="mb-0 mt-2">Campaign List</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_camping_page')}}" class="btn btn-info">Add Campaign</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                

                <div class="row my-4">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h4 class="">Search</h4>
                        <form action="{{URL::to('admin/camping_list')}}" method="post">
                            @csrf
                            
                            <div class="row search-box">

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Start Date</label>
                                        <input type="date" class="form-control" required  name="start_date" value="<?php echo isset($start_date)?date('Y-m-d',strtotime($start_date)):date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">End Date</label>
                                        <input type="date" class="form-control" required name="end_date" value="<?php echo isset($end_date)?date('Y-m-d',strtotime($end_date)):date('Y-m-d'); ?>" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group" style="margin-top: 21px;"> 
                                        <button type="submit" class="btn btn-success pull-right pull-rights"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </form> 
                    </div>
                    <div class="col-md-2"></div>

            </div>
            <form action="{{URL::to('admin/downloadCampaignPdf')}}" method="post">
                @csrf
                    <div class="row my-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info">Download Pdf</button>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table id="zero_config"
                        class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th><input name="" class="select_all" id="select_all" type="checkbox" ></th>
                                <th>Sl.</th>
                                <th>Owner name</th>
                                <th>Campaign name</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Form</th>
                                <th>Speed Time</th>
                                <th>Number of total spinn</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($camping as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td><input name="checkbox[]" class="checkbox" type="checkbox"  value="{{$item->id}}"></td>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>{{$item->campaign_name}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->sub_title}}</td>
                                    <td>{{$item->start_date}}</td>
                                    <td>{{$item->end_date}}</td>
                                    <td>{{$item->total_form}}</td>
                                    <td>{{$item->spinner_time}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->number_of_total_spinn}}</td>
                                    {{-- <td>
                                        <a href="{{URL::to('admin/edit_camping/'.$item->id)}}"><i class="fas fa-edit"></i></a>
                                        <a href="{{URL::to('admin/delete_camping/'.$item->id)}}"  onclick="dataDelete(event)"><i class="fas fa-trash-alt"></i></a>
                                    </td> --}}
                                </tr>
                                <!-- end row --> 
                            @endforeach

                            
                            
                        </tfoot>
                    </table>
                </div>
            </form>
            </div>
        </div>
        <!-- ---------------------
                end Zero Configuration
            ---------------- -->
    </div>
</div>
</div>

@endsection


@section('js')
    <script>

            
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });

        $("#zero_config").DataTable();
    </script>
@endsection