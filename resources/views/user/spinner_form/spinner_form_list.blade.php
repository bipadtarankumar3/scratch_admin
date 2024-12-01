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
                            <h5 class="mb-0">Spinner Form List</h5>
                        </div>
                        {{-- <div class="col-md-2">
                            <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add</a>
                        </div> --}}
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                <div class="row my-4">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h4 class="">Search</h4>
                        <form action="{{URL::to('admin/spinner_form_list/'.$id)}}" method="post">
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
                <form action="{{URL::to('admin/downloadSpinnerFormListPdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="campaign_id" value="{{$id}}">
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
                                <th>Date</th>
                                <th>Spinner Name</th>
                                <th>Bike Model Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Whatsapp Number</th>
                                <th>Phone</th>
                                <th>Screenshot</th>
                                <th>IP Address</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($SpinnerForm as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td><input name="checkbox[]" class="checkbox" type="checkbox"  value="{{$item->id}}"></td>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                            @if (!empty($item->spinner_name))
                                          {{$item->spinner_name}}  
                                        @else
                                        <spin class="text-danger">Item Deleted</spin>
                                            
                                        @endif
                                    </td>
                                    <td>{{$item->bike_name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->whatsapp_number}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td style="text-align: center">
                                        <img src="{{$item->schreenshot}}" alt="" width="100px"><br>
                                        <a href="{{$item->schreenshot}}" download="{{$item->name}}">Download</a>
                                    </td>
                                    <td>{{$item->mac_address}}</td>
                                    <td>
                                        <a href="#" onclick="spinner_form_details('{{$item->id}}')"><i class="fas fa-eye"></i></a>
                                        <a href="{{URL::to('admin/delete_spinner_form_list/'.$item->id)}}" onclick="dataDelete(event)"><i class="fas fa-trash-alt"></i></a>
                                    </td>
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


<div class="modal fade bd-example-modal-lg" id="add_spinner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body spinner_body">
          
          </div>
      </div>
    </div>
  </div>

@endsection


@section('js')
    <script>

        function spinner_form_details(id) {
            $.ajax({
                type: "GET",
                url: "{{URL::to('admin/spinner_form_details/')}}"+'/'+id,// where you wanna post
                data: {
                    'id':''
                },
                error: function(jqXHR, textStatus, errorMessage) {
                    console.log(errorMessage); // Optional
                },
                success: function(data) {
                    $('.spinner_body').html(data);
                    $('#add_spinner_modal').modal('show');
                } 
            });
        }

        function hide_modal(params) {
        $('#add_spinner_modal').modal('hide');
    }


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

        $("#zero_config").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'copy', 'excel',  'print'
        ]
    });

    


    </script>
@endsection