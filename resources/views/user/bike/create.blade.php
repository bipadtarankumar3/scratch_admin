@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create Choose Option </h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="">Choose Option </a></li>
                  <li class="breadcrumb-item" aria-current="page">Create Choose Option </li>
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
                    <h5>Create Choose Option </h5>
                  </div>
                <form method="POST" action="{{URL::to('admin/add_bike')}}" class="form-horizontal r-separator" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" @if (isset($bike)) value="{{$bike->id}}"  @endif>
                  

                  <div class="card-body border-top">

                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="mb-3">
                          <label for="title" class="control-label col-form-label">Name</label>
                          <input type="text" name="name"  @if (isset($bike)) value="{{$bike->name}}"  @endif class="form-control" id="title" placeholder="Add Choose Option" @required(true)>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-3">
                        <div class="mb-3">
                          <label for="inputcontact" class="control-label col-form-label">Status</label>
                          <select name="status" id=""  class="col-3 text-end control-label col-form-label form-control" required>
                            <option value="active" @if (isset($camping)) @if($camping->stauts =='active' ) selected @endif  @endif>Active</option>
                            <option value="inactive" @if (isset($camping)) @if($camping->stauts =='inactive' ) selected @endif  @endif>Inactive</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="action-form">
                      <div class="mb-3 mb-0 text-start">
                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                          Save
                        </button>
                        <a href="{{URL::to('admin/bike_model')}}">
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