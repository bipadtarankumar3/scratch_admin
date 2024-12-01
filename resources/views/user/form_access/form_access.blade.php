@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create Form Fields Access </h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="">Form Fields Access </a></li>
                  <li class="breadcrumb-item" aria-current="page">Create Form Fields Access </li>
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
                    <h5>Create Form Fields Access </h5>
                  </div>
                <form method="POST" action="{{URL::to('admin/form_access_post')}}" class="form-horizontal r-separator" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" @if (isset($FormFields)) value="{{$FormFields->id}}"  @endif>
                  

                  <div class="card-body border-top">

                    <div class="row">
                        {{-- <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Name</label>
                            <input type="checkbox" name="name"  @if (isset($FormFields)) checked  @endif  id="title">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Number</label>
                            <input type="checkbox" name="number"  @if (isset($FormFields)) checked @endif  id="title">
                            </div>
                        </div> --}}
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Whatsapp Number</label>
                            <input type="checkbox" name="whatsapp_no"  @if (isset($FormFields) && $FormFields->whatsapp_no == 'on') checked  @endif  id="title">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Email</label>
                            <input type="checkbox" name="email"  @if (isset($FormFields) && $FormFields->email == 'on') checked  @endif  id="title">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Address</label>
                            <input type="checkbox" name="address"  @if (isset($FormFields) && $FormFields->address == 'on') checked  @endif  id="title">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Choose option </label>
                            <input type="checkbox" name="choose_option"  @if (isset($FormFields) && $FormFields->choose_option == 'on') checked  @endif  id="title">
                             <a href="{{URL::to('admin/bike_model')}}">(Create)</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Screenshot  (Show/Hide)</label>
                            <input type="checkbox" name="screenshot"  @if (isset($FormFields) && $FormFields->screenshot == 'on') checked  @endif  id="screenshot">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 reqired_section" @if (isset($FormFields) && $FormFields->screenshot != 'on') style="display: none"  @endif  >
                            <div class="mb-3">
                            <label for="title" class="control-label col-form-label">Screenshot Required (Mandatory)</label>
                            <input type="checkbox" name="screenshot_required"  @if (isset($FormFields) && $FormFields->screenshot_required == 'on') checked  @endif  id="screenshot_required">
                            </div>
                        </div>
                     
                    </div>
                    
                    <div class="action-form">
                      <div class="mb-3 mb-0 text-start">
                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                          Save
                        </button>
                        <a href="{{URL::to('admin/form_access')}}">
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
        $('#screenshot').click(function() {
          $(".reqired_section").toggle(this.checked);
      });
    </script>
@endsection