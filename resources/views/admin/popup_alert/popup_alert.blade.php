@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create Popup Alert</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.html">Popup Alert</a></li>
                  <li class="breadcrumb-item" aria-current="page">Create Popup Alert</li>
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
          
          <div class="card w-100">
            <div class="card-header">
              <h5>Create  Popup Alert </h5>
            </div>
            <form method="POST" action="{{URL::to('admin/add_popup_alert')}}"  enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" @if (isset($popupalert)) value="{{$popupalert->id}}"  @endif>
              

              <div class="card-body border-top">
                <h5>Personal Info</h5>
                
                <div class="row">

                  <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                      <label for="title" class="control-label col-form-label">Title</label>
                      <input type="text" name="title"  class="form-control" id="title"  @if (isset($popupalert)) value="{{$popupalert->title}}"  @endif  placeholder="Title Here">
                       
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                      <label for="popup_img" class="control-label col-form-label">Image</label>
                      <input type="file" name="popup_img"  class="form-control" id="popup_img" >
                        @if (isset($popupalert)) 
                            <img src="{{$popupalert->popup_img}}" width="100px" alt="" style="margin-top: 10px">
                        @endif 
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-2">
                    <div class="mb-3">
                      <label for="inputcontact" class="control-label col-form-label">Status <span style="color: red;">*</span></label>
                      <select name="status" id=""  class="col-3 control-label col-form-label form-control" required>
                        <option value="active" style="background-color: green;color:white" @if (isset($popupalert)) @if($popupalert->status =='active' ) selected @endif  @endif>Active</option>
                        <option value="inactive"  style="background-color: red;color:white"  @if (isset($popupalert)) @if($popupalert->status =='inactive' ) selected @endif  @endif>Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="action-form">
                  <div class="mb-3 mb-0 text-start">
                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light submit_button">
                      Save
                    </button>
                   
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
      $('#name_url').keyup(function() {
        this.value = this.value.replace(/\s/g,'');
      });

      function check_username(name) {
          $.ajax({
              type: "GET",
              url: "{{URL::to('admin/user_name_checking')}}",// where you wanna post
              data: {
                  'name':name
              },
              error: function(jqXHR, textStatus, errorMessage) {
                  console.log(errorMessage); // Optional
              },
              success: function(data) {

                if (data == 'exist') {
                  $('.submit_button').attr('disabled','disabled');
                  $('.user_name_url').html('<p style="color:red">Already Exist</p>');
                } else {
                  $('.user_name_url').html('');
                  $('.submit_button').removeAttr('disabled');
                }

              } 
          });
      }
    </script>
@endsection