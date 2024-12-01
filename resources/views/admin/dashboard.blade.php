@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    @if (Auth::user()->type  == 'admin')
    <div class="row">
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total User</h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$Users}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Active User</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$ActiveUsers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-danger shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Inactive User</h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$InactiveUsers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-danger shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Expired User</h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$ExpiredUser}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @else
    <div class="row">
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Campaign </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$Camping}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Form Submit</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$SpinnerForm}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Customer Visit</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{Auth::user()->total_visit}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Create Spinner</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$Spinner}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Spin</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{Auth::user()->total_spin_round}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Wp Used</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{Auth::user()->wp_count}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @endif

    

  </div>

@endsection