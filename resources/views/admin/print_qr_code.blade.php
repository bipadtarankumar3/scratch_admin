<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:23 GMT -->
<head>

  <!-- Title -->

  <title>Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Required Meta Tag -->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Admin" />
  <meta name="author" content="" />
  <meta name="keywords" content="Admin" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />


  <!-- Favicon -->

  <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">


  <!-- Core Css -->

  <link rel="stylesheet" href="{{asset('adminAssets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">

  <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
  
  {{-- <link rel="stylesheet" href="{{asset('adminAssets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('adminAssets/css/my-style.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Include HTML2Canvas library -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <style>
    /* Your regular styles go here */

    @media print {
        body {
            -webkit-print-color-adjust: exact; /* For Webkit browsers like Chrome and Safari */
            color-adjust: exact; /* Standard property */
        }
        @page {
                size: portrait; /* or specify the desired size */
                margin: 10mm;
            }
    }

    * {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
    color-adjust: exact !important;                 /* Firefox 48 – 96 */
    print-color-adjust: exact !important;           /* Firefox 97+, Safari 15.4+ */
}
</style>
</head>

<body  style="background-image: unset;"> 

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-3 text-center">
              <a href="#" onclick="printDiv('qr_box')"  class="btn btn-success my-2 float-center" style="font-size: 20px"><i class="fa-solid fa-print"></i> Print</a>
              <a href="{{URL::to('admin/dashboard')}}"  class="btn btn-secondary my-2 float-center" style="font-size: 20px"><i class="fa-solid fa-arrow-left"></i> Back</a>
  
        </div>
        <div class="col-md-4"></div>
    </div>
 <div class="row my-4 ">
    <div   class="col-12 col-md-5"></div>
    <div class="col-12 col-md-3"  >
        
        <div style="text-align: center;border: 1px solid white;" class="qr_box" id="qr_box" >
            <div style="background-image:url('{{asset('frontend/images/qr.jpg')}}'); background-position: top;
    padding: 0px;background-size: contain;    background-repeat: no-repeat;height: 600px;">
            
            <div class="" style="height: 110px;
            ">
                <h2 style="font-weight: 800;font-size: 35px;"></h2>
                <br>
              
            </div>
          
            <div class="qr_logo_section" style="height: 150px;margin-top:90px;">
                <img src="{{Auth::user()->logo}}" alt="" style="height: 130px;">
            </div>
            <div class="qr_section">
                @php
                    $url = URL::to("u/".Auth::user()->name_url);
                @endphp
                {!! QrCode::size(140)->generate($url) !!}
            </div>
            <div class="qr_desc_section my-4" style="padding: 0px 50px 0px 50px;">
                
            </div>
            {{-- <div class="qr_desc_google my-4" style="height: 91px;" >
                <img src="{{asset('frontend/images/gog_rev.png')}}" alt="" style="height: 80px;
                width: 55%;" >
            </div> --}}
            {{-- <div class="qr_desc_power_by" style="margin-top:0.7rem;height: 23px;">
                <img src="{{asset('frontend/images/power_by.png')}}" style="height: 20px;" alt="">
                <img src="{{asset('frontend/images/ask.png')}}" style="height: 29px;" alt="">
            </div> --}}
            
        </div>
        </div>
    </div>
    <div   class="col-12 col-md-4"></div>
 </div>
</div>



  <!-- Customizer -->
  <!-- Import Js Files -->
  <script src="{{asset('adminAssets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('adminAssets/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{asset('adminAssets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- core files -->
  <script src="{{asset('adminAssets/js/app.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/app.minisidebar.init.js')}}"></script>
  <script src="{{asset('adminAssets/js/app-style-switcher.js')}}"></script>
  <script src="{{asset('adminAssets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('adminAssets/js/custom.js')}}"></script>
  <!-- current page js files -->
  <script src="{{asset('adminAssets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/dashboard4.js')}}"></script>
  {{-- <script src="{{asset('adminAssets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}

  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Toastr -->

  
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
 


  @yield('js')


  <script>
    @if(Session::has('messege'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('messege')}}");
            bresk;
        case 'success':
            toastr.success("{{Session::get('messege')}}");
            bresk;
        case 'worning':
            toastr.worning("{{Session::get('messege')}}");
            bresk;
        case 'error':
            toastr.error("{{Session::get('messege')}}");
            bresk;
    }
    @endif


    
    function dataDelete(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute(
            'href'
            ); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = urlToRedirect;
            } else {
                return false;
            }
        });
    }
  </script>

<script>
    function printDiv(tagid) {
        var hashid = "#"+ tagid;
        var tagname =  $(hashid).prop("tagName").toLowerCase() ;
        var attributes = ""; 
        var attrs = document.getElementById(tagid).attributes;
          $.each(attrs,function(i,elem){
            attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
          })
        var divToPrint= $(hashid).html() ;
        console.log(divToPrint);
        var head = "<html><head>" + $("head").html() +
    // Add a @page CSS rule for portrait mode
    "<style>@page { size: portrait; }</style>" +
    "</head>";
        var allcontent = head + "<body  onload='window.print()'  style='background-image: unset;' ><div   style='width: 100%;display:flex'><div   style='width: 20%'></div><div   style='width: 60%'>"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  "</div><div   style='width: 20%'></div></div></body></html>"  ;
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write(allcontent);
        newWin.document.close();
       // setTimeout(function(){newWin.close();},10);
    }
</script>


</body>


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:25 GMT -->
</html>

