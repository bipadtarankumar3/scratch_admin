@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create sitesetting</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.html">sitesetting</a></li>
                  <li class="breadcrumb-item" aria-current="page">Create sitesetting</li>
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
              <h5>Create sitesetting </h5>
            </div>
            <form method="POST" action="{{URL::to('admin/add_sitesetting')}}"  enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" @if (isset($sitesetting)) value="{{$sitesetting->id}}"  @endif>
              

              <div class="card-body border-top">
                
                <div class="row">

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="music" class="control-label col-form-label">Music</label>
                      <input type="file" name="file"  class="form-control" id="music" >
                      @if (isset($sitesetting)) 
                      <audio controls>
                        {{-- <source src="horse.ogg" type="audio/ogg"> --}}
                        <source src="{{$sitesetting->background_music}}" type="audio/mpeg">
                        Your browser does not support the audio tag.
                      </audio>
                      @endif
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-2">
                    <div class="mb-3">
                      <label for="inputcontact" class="control-label col-form-label">Status <span style="color: red;">*</span></label>
                      <select name="status" id=""  class="col-3 control-label col-form-label form-control" required>
                        <option value="active" style="background-color: green;color:white" @if (isset($sitesetting)) @if($sitesetting->background_music_status =='active' ) selected @endif  @endif>Active</option>
                        <option value="inactive"  style="background-color: red;color:white"  @if (isset($sitesetting)) @if($sitesetting->background_music_status =='inactive' ) selected @endif  @endif>Inactive</option>
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