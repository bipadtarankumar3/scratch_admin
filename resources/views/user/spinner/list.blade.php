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
                            <h5 class="mb-0">Spinner List</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Spinner</a>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                <div class="row my-4">
                    <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <h4 class="">Search</h4>
                            <form action="{{URL::to('admin/spinner_list')}}" method="post">
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

                <form action="{{URL::to('admin/downloadSpinnerPdf')}}" method="post">
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
                                <th>Camping Name</th>
                                <th>Name</th>
                                
                                <th>Max Qty</th>
                                @if (Auth::user()->default_spinn == 2)
                                <th>Chances</th>
                                @else
                                <th>Image</th>
                                <th>Skip</th>
                                @endif
                                <th>Color</th>
                                
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($Spinner as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td><input name="checkbox[]" class="checkbox" type="checkbox"  value="{{$item->id}}"></td>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->c_title}}</td>
                                    <td>{{$item->name}}</td>
                                    
                                    <td>{{$item->value}}</td>

                                    @if (Auth::user()->default_spinn == 2)
                                    <td>{{$item->chances}}</td>
                                    @else
                                    <td><img src="{{$item->image}}" alt="" width="90px"></td>
                                    <td>{{$item->skip}}</td>
                                    @endif

                                    
                                    <td> <div style="height: 30px;width:90px;background:{{$item->color}}" ></div> </td>
                                    
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <a href="#" onclick="edit_spinner('{{URL::to('admin/edit_spinner/'.$item->id)}}')"><i class="fas fa-edit"></i></a>
                                        <a href="{{URL::to('admin/delete_spinner/'.$item->id)}}" onclick="dataDelete(event)"><i class="fas fa-trash-alt"></i></a>
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
            <h5 class="modal-title" id="exampleModalLabel">Spinner</h5>
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
    } );

    function add_spinner_btn() {
     
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/spinner_form')}}",// where you wanna post
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

    function edit_spinner(url) {
     
        $.ajax({
            type: "GET",
            url: url,// where you wanna post
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

    function add_spinner_submit() {

        var spin_round = $('.value').val();
        if (spin_round == '') {
            $('.spin_round_error').html('Please Enter Spin Round Value');
            return;
        } else {
            $('.spin_round_error').html('');
        }

        var url = $('#spinner_form').attr("action");
        var form = $('#spinner_form')[0];
        // console.log(url);return;
        var formData = new FormData(form);// yourForm: form selector        
        $.ajax({
            type: "POST",
            url: url,// where you wanna post
            data: formData,
            processData: false,
            contentType: false,
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                console.log(data);
                swal({
                      title: "Success",
                      text: "Thank you for submit.",
                      type: "success",
                      confirmButtonText: "Cool"
                    });
                    
                    setTimeout(() => {
                      location.reload(true);
                    }, 1500);
            } 
        });

    }

    function hide_modal(params) {
        $('#add_spinner_modal').modal('hide');
    }

    </script>
@endsection