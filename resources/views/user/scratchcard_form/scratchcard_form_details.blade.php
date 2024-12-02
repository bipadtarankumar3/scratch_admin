<form method="POST" action="{{URL::to('admin/add_spinner')}}" class="form-horizontal r-separator" id="spinner_form" enctype="multipart/form-data">
   
    <div class="card-body">

  
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Date</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->created_at}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Spinner Name</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->spinner_name}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Choose Option Name</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->bike_name}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Name</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->name}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Email</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->email}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Whatsapp Number</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->whatsapp_number}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Phone</label>
        <div class="col-9 border-start pb-2 pt-2">
          {{$ScratchcardForm->phone}}
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">Schreenshot</label>
        <div class="col-9 border-start pb-2 pt-2">
            <img src="{{$ScratchcardForm->schreenshot}}" alt="" width="100px"><br>
            <a href="{{$ScratchcardForm->schreenshot}}" download="{{$ScratchcardForm->name}}">Download</a>
        </div>
      </div>
      <div class="form-group row align-items-center mb-0">
        <label for="anme" class="col-3 text-end control-label col-form-label">IP Address</label>
        <div class="col-9 border-start pb-2 pt-2">
            {{$ScratchcardForm->mac_address}}
        </div>
      </div>
  
      
    </div>

  </form>