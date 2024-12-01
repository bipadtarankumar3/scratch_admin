@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create IP Skip </h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="">IP Skip </a></li>
                  <li class="breadcrumb-item" aria-current="page">Create IP Skip </li>
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
                    <h5>Create IP Skip </h5>
                  </div>
                <form method="POST" action="{{URL::to('admin/add_ip_skip')}}" class="form-horizontal r-separator" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" @if (isset($ip_skip)) value="{{$ip_skip->id}}"  @endif>
                  

                  <div class="card-body border-top">

                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="title" class="control-label col-form-label">IP</label>
                          <input type="text" name="ip"  @if (isset($ip_skip)) value="{{$ip_skip->ip}}"  @endif class="form-control" id="title" placeholder="Add ip" @required(true)>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-3">
                        <div class="mb-3">
                          <label for="inputcontact" class="control-label col-form-label">Status</label>
                          <select name="status" id=""  class="col-3 text-end control-label col-form-label form-control" required>
                            <option value="active" @if (isset($ip_skip)) @if($ip_skip->stauts =='active' ) selected @endif  @endif>Active</option>
                            <option value="inactive" @if (isset($ip_skip)) @if($ip_skip->stauts =='inactive' ) selected @endif  @endif>Inactive</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="action-form">
                      <div class="mb-3 mb-0 text-start">
                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                          Save
                        </button>
                        <a href="{{URL::to('admin/ip_skip')}}">
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