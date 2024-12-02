@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Create scratchcard</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.html">scratchcard</a></li>
                  <li class="breadcrumb-item" aria-current="page">Create scratchcard</li>
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
                <h5>Create scratchcard </h5>
              </div>
                <div class="card-body">
                  {{-- <h5>User</h5> --}}
                 
                </div>
                <form method="POST" action="{{URL::to('admin/add_scratchcard')}}" class="form-horizontal r-separator" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" @if (isset($ScratchCard)) value="{{$ScratchCard->id}}"  @endif>
                  <div class="card-body">

                    <div class="form-group row align-items-center mb-0">
                      <label for="camping_id" class="col-3 text-end control-label col-form-label">Campaign</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <select name="camping_id" id="camping_id"  class="col-3 text-end control-label col-form-label form-control" required>
                          <option value="" >Select</option>
                          @foreach ($camping as $item)
                              <option value="{{$item->id}}" @if (isset($ScratchCard)) @if($ScratchCard->camping_id == $item->id) selected @endif  @endif>{{$item->name}}</option>
                          @endforeach
                          
                        </select>
                      </div>
                    </div>

                    <div class="form-group row align-items-center mb-0">
                      <label for="anme" class="col-3 text-end control-label col-form-label"> Name</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="text" name="name"  @if (isset($ScratchCard)) value="{{$ScratchCard->name}}"  @endif class="form-control" id="anme" placeholder="Name Here" @required(true)>
                      </div>
                    </div>

                    <div class="form-group row align-items-center mb-0">
                      <label for="description" class="col-3 text-end control-label col-form-label">Description</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="text" name="description"  @if (isset($ScratchCard)) value="{{$ScratchCard->description}}"  @endif class="form-control" id="description" placeholder="Description Here" @required(true)>
                      </div>
                    </div>
   
                    <div class="form-group row align-items-center mb-0">
                      <label for="inputEmail3" class="col-3 text-end control-label col-form-label">Image</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="file" name="file"  class="form-control" id="inputEmail3" placeholder="Email Here">
                      </div>
                    </div>
                    
                    <div class="form-group row align-items-center mb-0">
                      <label for="no_of_time_scratch" class="col-3 text-end control-label col-form-label">No of time scratch</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="text" name="no_of_time_scratch"  @if (isset($ScratchCard)) value="{{$ScratchCard->no_of_time_scratch}}"  @endif class="form-control" id="no_of_time_scratch" placeholder="no of time scratch Here">
                      </div>
                    </div>
                    
                    <div class="form-group row align-items-center mb-0">
                      <label for="date" class="col-3 text-end control-label col-form-label">Color</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="color" name="color"  @if (isset($ScratchCard)) value="{{$ScratchCard->color}}"  @endif class="form-control" id="date" placeholder="Color Here" @required(true)>
                      </div>
                    </div>
                    <div class="form-group row align-items-center mb-0">
                      <label for="price" class="col-3 text-end control-label col-form-label">Price</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="price" name="price"  @if (isset($ScratchCard)) value="{{$ScratchCard->price}}"  @endif class="form-control" id="price" placeholder="price Here" @required(true)>
                      </div>
                    </div>
                    <div class="form-group row align-items-center mb-0">
                      <label for="order" class="col-3 text-end control-label col-form-label">Price</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <input type="order" name="order"  @if (isset($ScratchCard)) value="{{$ScratchCard->order}}"  @endif class="form-control" id="order" placeholder="order Here" @required(true)>
                      </div>
                    </div>
                    
                    
                    <div class="form-group row align-items-center mb-0">
                      <label for="note" class="col-3 text-end control-label col-form-label">Status</label>
                      <div class="col-9 border-start pb-2 pt-2">
                        <select name="status" id=""  class="col-3 text-end control-label col-form-label form-control" required>
                          <option value="active" style="background-color: green;color:white" @if (isset($ScratchCard)) @if($ScratchCard->card_status =='active' ) selected @endif  @endif>Active</option>
                          <option value="inactive" style="background-color: red;color:white" @if (isset($ScratchCard)) @if($ScratchCard->card_status =='inactive' ) selected @endif  @endif>Inactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="p-3 border-top">
                    <div class="form-group mb-0 text-end">
                      <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                        Save
                      </button>
                      <a href="{{URL::to('admin/scratchcard_list')}}">
                        <button type="button" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">
                          Cancel
                        </button>
                      </a>
                      
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>

@endsection