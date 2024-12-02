@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create Campaign </h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="">Campaign </a></li>
                  <li class="breadcrumb-item" aria-current="page">Create Campaign </li>
                </ol>
              </nav>
            </div>
            <div class="col-3">
              <div class="text-center mb-n5">  
                <img src="{{asset('adminAssets/images/breadcrumb/ChatBc.png')}}" alt="" class="img-fluid mb-n4">
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- basic table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                  <div class="card-header">
                    <h5>Create Campaign </h5>
                  </div>
                <form method="POST" action="{{URL::to('admin/add_camping')}}" class="form-horizontal r-separator" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" @if (isset($camping)) value="{{$camping->id}}"  @endif>
                  

                  <div class="card-body border-top">

                    <div class="row">
                      <div class="col-sm-12 col-md-4"></div>
                      <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                          <label for="title" class="control-label col-form-label">Campaign name</label>
                          <input type="text" name="campaign_name"  @if (isset($camping)) value="{{$camping->campaign_name}}"  @endif class="form-control" id="title" placeholder="Campaign name" @required(true)>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-4"></div>
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                          <label for="title" class="control-label col-form-label">Title</label>
                          <input type="text" name="title"  @if (isset($camping)) value="{{$camping->title}}"  @endif class="form-control" id="title" placeholder="title Here" @required(true)>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-2">
                        <div class="mb-3">
                          <label for="title_status" class="control-label col-form-label">Checked To Show Title</label>
                          <br>
                          <input type="checkbox" name="title_status"  @if (isset($camping)) @if ($camping->title_status == 'on') checked @endif  @endif  id="title_status" placeholder="title_status Here">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                          <label for="name_url" class="control-label col-form-label">Sub Title</label>
                          <input type="text" name="sub_title"  @if (isset($camping)) value="{{$camping->sub_title}}"  @endif class="form-control" id="sub_title" placeholder="Sub Title Here" @required(true)>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-2">
                        <div class="mb-3">
                          <label for="sub_title_status" class="control-label col-form-label">Checked To Show Sub Title</label>
                          <br>
                          <input type="checkbox" name="sub_title_status"  @if (isset($camping)) @if ($camping->sub_title_status == 'on') checked @endif  @endif  id="sub_title_status" >
                        </div>
                      </div>
                      
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="inputcontact" class="control-label col-form-label">Start Date ( It`s show on your website )</label>
                          <input type="date" name="start_date"  @if (isset($camping)) value="{{$camping->start_date}}"  @else value="{{date('Y-m-d')}}"  @endif class="form-control" id="start_date" placeholder="value Here">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                          <label for="inputlname" class="control-label col-form-label">End Date</label>
                          <input type="date" name="end_date"  @if (isset($camping)) value="{{$camping->end_date}}"  @endif class="form-control" id="end_date" placeholder="value Here">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-2">
                        <div class="mb-3">
                          <label for="validity_status" class="control-label col-form-label">Checked To Show Validity Text</label>
                          <br>
                          <input type="checkbox" name="validity_status"  @if (isset($camping)) @if ($camping->validity_status == 'on') checked @endif  @endif  id="validity_status" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      
                      
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="inputEmail3" class="control-label col-form-label">Scratch % ( Recommend time 45 - 50 %)</label>
                          <input type="number" name="scratch_time" onkeyup="second_validate(this)" @if (isset($camping)) value="{{$camping->scratch_time}}"  @endif  min="10" max="60" class="form-control" id="total_form" placeholder="value Here">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="inputEmail3" class="control-label col-form-label">Number of total spinn</label>
                          <input type="number" name="number_of_total_spinn"  @if (isset($camping)) value="{{$camping->number_of_total_spinn}}"  @endif class="form-control" id="number_of_total_spinn" placeholder="value Here">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      
                      <div class="col-sm-12 col-md-2">
                        <div class="mb-3">
                          <label for="inputcontact" class="control-label col-form-label">Status</label>
                          <select name="status" id=""  class="col-3 control-label col-form-label form-control" required>
                            <option value="active"  style="background-color: green;color:white" @if (isset($camping)) @if($camping->status =='active' ) selected @endif  @endif>Active</option>
                            <option value="inactive"  style="background-color: red;color:white" @if (isset($camping)) @if($camping->status =='inactive' ) selected @endif  @endif>Inactive</option>
                          </select>
                        </div>
                      </div>
                    </div>

    
                    <div class="action-form">
                      <div class="mb-3 mb-0 text-start">
                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                          Save
                        </button>
                        <a href="{{URL::to('admin/camping_list')}}">
                          <button type="button" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">
                            Cancel
                          </button>
                        </a>
                      </div>
                    </div>
    
                  </div>

                </form>
              </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
      function second_validate(get_this) {
        var max = parseFloat($(get_this).attr('max'));
          var min = parseFloat($(get_this).attr('min'));
          if (parseFloat($(get_this).val()) > max) {
              $(get_this).val(10);
          } 
      }
    </script>
@endsection 