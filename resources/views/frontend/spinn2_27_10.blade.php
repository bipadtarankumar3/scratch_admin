<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
          @if ($Camping->title_status == 'on')
      {{$Camping->title}}
      @else
      Prize Wheel
      @endif
        </title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        {{-- <script type="text/javascript" src="https://ramjeehonda.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script> --}}

        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 


        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

        {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}

        {{-- <link href="./myStyle.css" rel="stylesheet"> --}}

        <link rel="stylesheet" href="{{asset('frontend/spinner/wheel/main.css')}}" type="text/css" />
        <script type="text/javascript" src="{{asset('frontend/spinner/wheel/Winwheel.js')}}"></script>
        <script src="{{asset('frontend/spinner/wheel/TweenMax.min.js')}}"></script>
        <link rel='stylesheet' type='text/css' href='{{asset('frontend/spinner/wheel/rotation.css')}}' />	

        <link rel="stylesheet" href="{{asset('frontend/award/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/spinner/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/spinn_two/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/spinn_two/my-style.css')}}">
    

    </head>
<body @if($user->default_background == 'color') style="background:{{$user->background_color}}" @else style="background:url('{{$user->background_image}}');background-repeat: no-repeat;
        background-size: cover;background-position: top;height: 100%;"  @endif >


        <div class="entry-content">
        
        
                
            <div  class='container mt-4'  id='cn_wheel_main_div'>
            
                <div class='row '>
                
                    <div class='col-sm-5 text_col'>
                    
                        <div class=" camping_box">
                            <div class="row my-2" style="margin-top:0px!important">
                            <div class="col-md-12">
                                @php
                                    $notice = DB::table('notices')->where('user_id',$user->id)->where('status','active')->first();
                                @endphp
                                @if ($notice != '' && $notice->status == 'active')
                                    <div>
                                    <marquee  direction="left" onmouseover="this.stop();" onmouseleave="this.start();" style="height: 31px;">
                                    <p style="color: red;margin-top: 10px;margin-left: 20px;">
                                        {{$notice->notice}}
                                    </p>
                                    </marquee>
                                    </div>
                                @endif
                                <div class="img_box">
                                <img src="{{$user->logo}}" class="logo_image" alt="">
                                </div>
                                @if ($Camping->title_status == 'on')
                                    <h4 class="mt-2">{{$Camping->title}}</h4>
                                @endif
                    
                                @if ($Camping->sub_title_status == 'on')
                                    <p style="padding: 0px;margin:0px">{{$Camping->sub_title}}</p>
                                @endif
                    
                    
                                @if ($Camping->validity_status == 'on')
                                    <h3 style="padding: 0px;margin:0px">Offer Valid From : 
                                    <span style="color: green">
                                        <?php
                                        $date=date_create($Camping->start_date);
                                        echo date_format($date,"d/m/Y");
                                        ?>
                                    </span> To 
                                    <span style="color: red">
                                        <?php
                                        $date=date_create($Camping->end_date);
                                        echo date_format($date,"d/m/Y");
                                        ?>
                                    </span>
                                    </h3>
                                @endif
                    
                                @if ($SpinnerFormAccessCount == 'NO_LIMIT')
                                    
                                @else
                                <p class="spin_time">Total Spin Times Limit : 
                                    <span style="color: red" class="spin_time_count"> 
                                        @php
                                        echo $count = $user->spin_whell_round - $SpinnerFormAccessCount;
                                        @endphp
                                    </span>
                                </p>
                                @endif
                    
                                
                                
                                
                            </div>
                            </div>
                        </div>
                    
                        <div class="background_form_part" style="display: none">
                        
                            <input type='text' name='name' class='form-control' placeholder='Name' id='p_name' required value=""> 
                            <br>
                            <input type='text' name='mobile' class='form-control' placeholder='Mobile' id='p_mobile' required>
                            <br>
                            
                            <div style='text-align:center;'> 
                            
                                <button id="spin_button"  class="btn btn-sm btn-success background_form_btn" onClick="submit_from()"> Spin To Win</button>
                        
                            </div>
                            
                            <div class='error_alert alert alert-danger mt-3'>
                            
                                <h5 id='alert_msg'>  </h5>
                            
                            </div>
                            
                            
                        </div>
                    
                    </div>
                    
                    <div class='col-sm-7 mt-4 spinner_col'>
                    
                    
                            <div class="mb-4 spinner_box" style='text-align:center;'>
                            
                                <div class='the_wheel p-4' style=''>
                            
                                        <canvas id="canvas" width='434'  height='434' style='' >
                                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                                        </canvas>
                                        
                                        
                                        <div style='position:absolute;top:50px;left:3px;width:100%;text-align:center;' id='new_pin_div'>
                                            <img src="{{asset('frontend/spinner/wheel/pin.png')}}" style='width:100px;' id='new_pin'>
                                        </div>
                                </div>

                                <button id="spin_button"  class="btn  btn-success spin_form_btn my-4" onClick="submit_from()"> Spin To Win</button>
                                
                    
                            </div>
                    
                    </div>
                
                </div>
                
            
            </div>    
                
                
                
                
        
            <div class="entry-links"></div>
        </div>
       


    
<div class="blast" style="display: none">
    <div class="content">
        <div class="trophy">
            <img src="{{asset('frontend/spinner/wheel/trophy.png')}}" class="trophy_img" alt="trophy">
            <br>
            <img src="" alt="" srcset="" class="spinner_image_show" width="40%">
        </div>
        <div class="text text-center">
            <h2 class="my-3">Congratulations, you won!</h2>
            <h1 class="award_text">Award</h1>
        </div>
        <div class="text text-center">
            <button class="btn btn-warning reedem-btn" onclick="check_user_spinner_submit()" >Reedem</button>
        </div>

    </div>
  </div>

    <audio  id="error"  >
        <source src="{{asset('mp3/error.mp3')}}"  type="audio/mpeg">
        
    </audio>
    <audio  id="own"  >
        <source src="{{asset('mp3/won.mp3')}}"  type="audio/mpeg">
        
    </audio>
    <audio  id="circleSound" >
        <source src="{{asset('mp3/wheel2.mp3')}}"  type="audio/mpeg">
    </audio>

    <style>
            
        .error_alert, .prize_msg_alert{
             
             display:none;
        }
      
      </style>

        <!-- Modal -->
  <div class="modal fade" id="ReedemModal" tabindex="-1" role="dialog" aria-labelledby="ReedemModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Reedem Gift</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @if (!empty($FormFields) && $FormFields->screenshot == 'on')
              <h5>If you have a Screenshot then please click on Next button and if have not Please Take Screenshot.</h5>
              <p>
                यदि आप Screenshot लेकर नहीं रखे है तो 
                कृपया Screenshot लेकर Next दबाए और आगे अपलोड करे !
              </p>
            @else
              <h5>धन्यवाद! आपने Prize Wheel के माध्यम से अपना ऑफर सुनिश्चित किया है 
                उसको Reedem के लिए कृपया Next दबाकर अपना डिटेल डाले |</h5>
            @endif
        </div>
        <div class="modal-footer">
            @if (!empty($FormFields) && $FormFields->screenshot == 'on')
              <button type="button" class="btn btn-secondary take_screenshot" data-dismiss="modal">Take Screenshot</button>
            @endif
          
          <button type="button" class="btn btn-success"  onclick="open_form_modal()">Next</button>
        </div>
      </div>
    </div>
  </div>



  
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg FormModal" id="FormModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-header" style="background: #fff;">
            <h5 class="modal-title" id="exampleModalLongTitle">Submit your details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-content">
            <form class="my-4 p-4" action="{{URL::to('u/spinner_form/post')}}" method="POST" id="spinner_form" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="spinner_id" id="spinner_id">
              <input type="hidden" name="spinner_name" id="spinner_name">
              <input type="hidden" name="spinner_value" id="spinner_value">
              <div class="form-row">
                <div class="form-group col-md-3"></div>
                <div class="form-group col-md-6 text-center">
                  <img src="" alt="" srcset="" class="spinner_image" width="40%">
                  <h3>Congratulations, you won!</h3>
                  
                  <h3 class="spinner_name_text"></h3>
                </div>
                <div class="form-group col-md-3"></div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Mobile Number</label>
                  <input type="text" name="phone" class="form-control" id="phone" min="10"  onkeyup="numOnly(this)" onblur="numOnly(this)" maxlength="10" placeholder="Mobile Number" required>
                  <span id="phone_error"  style="color:red"></span>
                </div>
                
                
              </div>
              <div class="form-row">
                @if (!empty($FormFields) && $FormFields->whatsapp_no == 'on')
                <div class="form-group col-md-4">
                  <label for="whatsapp_number">Whatsapp Number</label>
                  <input type="text" name="whatsapp_number" class="form-control" min="10"  onkeyup="wpNumOnly(this)" onblur="numOnly(this)"  maxlength="10" id="whatsapp_number" placeholder="whatsapp Number" required>
                  <span id="wp_phone_error"  style="color:red"></span>
                </div>
                @endif
                @if (!empty($FormFields) && $FormFields->email == 'on')
                    
                
                <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                @endif
                @if (!empty($FormFields) && $FormFields->address == 'on')
                    
                
                <div class="form-group  col-md-4">
                  <label for="address">Address</label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="">
                </div>
                @endif
              </div>
              <div class="form-row">
  
                @if (!empty($FormFields) && $FormFields->choose_option == 'on')
  
                @if (count($BikeModel) > 0)
                    <div class="form-group col-md-6">
                      <label for="screenshot">Are You Interested in</label>
                      <select name="bike_model_id" id="bike_model_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach ($BikeModel as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                    </div>
                @endif
                @endif
                @if (!empty($FormFields) && $FormFields->screenshot == 'on')
                <div class="form-group col-md-6">
                  <label for="screenshot">Screenshot </label>
                  <input type="file" name="screenshot" class="form-control" @if (!empty($FormFields) && $FormFields->screenshot_required == 'on') required @endif id="screenshot" placeholder="Screenshot">
                </div>
                @endif
               
              </div>
              @if (!empty($FormFields) && $FormFields->screenshot == 'on')
              <button type="button" class="btn btn-secondary form_take_screenshot" data-dismiss="modal">Take Screenshot</button>
              @endif
              <button type="submit" class="btn btn-primary form_submit_button">Submit</button>
            </form>
          </div>
        </div>
      </div>
  
  
      
    @php
    $popup = DB::table('popupalerts')->where('user_id',$user->id)->orderBy('id','desc')->first();
  @endphp
    <div class="modal fade quotation newsShowPopupModal"  tabindex="-1" aria-labelledby="smallQuoteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"  style="width: 95%;">
  
          <div class="modal-body">
  
            <div class="" style="float: right;">
                <button type="button" class="btn-close popup_close"  onclick="popupModalClose()" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
              <div class="modal-content" style="    text-align: center;border: 0px solid rgb(0, 0, 0);">
                @if (!empty($popup))
                   
                   @if (!empty($popup->popup_img))
                      <h4>{{$popup->title}}</h4> 
                   @endif
                   @if (!empty($popup->popup_img))
                        <img src="{{$popup->popup_img}}" alt=""  style="height: 405px;">   
                   @endif
                 
                @endif
                  
                </div>
            
          </div>
  
        </div>
      </div>
    </div>
  
  
  
     <!-- Preloader -->
  <div id="preloader" style="display: none">
    <div id="status">&nbsp;</div>
  </div>
      <style>
        /* Preloader */
  
  #preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ffffff91;
      z-index: 9999;
    /* makes sure it stays on top */
  }
  
  #status {
    width: 200px;
    height: 200px;
    position: absolute;
    left: 50%;
    /* centers the loading animation horizontally one the screen */
    top: 50%;
    /* centers the loading animation vertically one the screen */
    background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
    /* path to your loading animation */
    background-repeat: no-repeat;
    background-position: center;
    margin: -100px 0 0 -100px;
    /* is width and height divided by two */
  }
      </style>
  
  



<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
<script  src="{{asset('frontend/award/js/blast.js')}}"></script>

      
       <script>

        var  playing = false;
       
        function show_alert_error(msg)
          {
               $('#alert_msg').text(msg);
               $('.error_alert').show();
               
               location.href='#p_mobile';
          }
          
          function hide_alert_error()
          {
          
              $('.error_alert').hide();
          }
          
          
          function show_prize_msg(msg)
          {
               $('#prize_msg').text(msg);
               $('.prize_msg_alert').show();
               location.href='#p_mobile';
          }
          
          function hide_prize_msg()
          {
               $('#code_msg').html('');
               
              $('.prize_msg_alert').hide();
          }
          
          
          function show_code_msg(msg)
          {
               $('#code_msg').html(msg);
               
              // $('.prize_msg_alert').show();
               
               //location.href='#p_mobile';
          }
          
          function submit_from()
          {

            
        swal({
            title: "Best Of Luck",
            text: "If you click on 'Yes' button it will reduce your spin limit",
            type: "success",
            showCancelButton: true,
            confirmButtonColor: 'green',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){

            if (isConfirm){

                $('.confirm').attr('disabled','disabled');

                
                $.ajax({
                url: "{{URL::to('u/spinner_round_check')}}",
                    type: 'post',
                    // dataType: 'application/json',
                    data:  {
                        user_id:'{{$user->id}}',
                        campaign_id:'{{$Camping->id}}',
                    },
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                    
                        $('.spin_time_count').html(data.total_count);
                        if (data.status == false) {
                        swal({
                            title: "Oh! Sorry",
                            text: "<h2>"+data.message+"</h2><p style='margin:7px'><b>Helpline Number</b></p><a href='tel:{{$user->phone}}'><p><i class='fas fa-phone'></i> {{$user->phone}}</a>",
                            html: true,
                            type: "error",
                            confirmButtonText: "Ok"
                        });

                        document.getElementById('error').play();
                        playing = true;
                        return;

                        }else{

                            hide_alert_error();
                            hide_prize_msg();
            

                            // if($('#p_name').val() == '' || $('#p_name').val() == ' ' )
                            // {
                            //     //alert('Enter name !');
                                
                            //     show_alert_error('Enter name !');
                                
                            // }
                                        
                            // else if($('#p_mobile').val() == '' || $('#p_mobile').val() == ' ' || (!$('#p_mobile').val().match('[0-9]{10}')) ||   ($('#p_mobile').val().length!=10)  )
                            // {
                            //    // alert('Enter valid 10 digit mobile number !');
                                
                            //    //show_alert_error('Enter valid 10 digit mobile number !');
                            // }
                            
                            // else
                            // {
                                document.getElementById('circleSound').play();
                                playing = true;

                                    $.ajax({
                                    url: "{{URL::to('form_submit')}}",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Set the CSRF token
                                    },
                                    data: {
                                        campaign_id: "{{$campaign_id}}",
                                        name: $('#p_name').val(),
                                        mobile: $('#p_mobile').val(),
                                        // Add any other fields you need to send
                                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                                    },
                                    success: function(response) {
                                        
                                        if (response.data) {
                                            // Call calculatePrize with the received angles
                                            calculatePrize(response.data.degree,response.data.after_angle, response.data.seg_angle);
                                            show_code_msg('Your code is <b>' + response.data.code + '</b>');
                                        } else {
                                            show_alert_error(response.message);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        show_alert_error('An error occurred: ' + error);
                                    }
                                });

                            // }

                            swal.close();

                        }
                        $('.confirm').removeAttr('disabled');
                        
                    },
                    error: function(err) {
                        reject(err) // Reject the promise and go to catch()
                    }
                });

            } else {
            swal("Cancelled", "Your spin wheel is cancled :)", "error");
            }
            }  
            
            )
        }
    
             
       
          // Create new wheel object specifying the parameters at creation time.
          
          var theWheel = new Winwheel({
              'numSegments'  : {{$spinn_count}},     // Specify number of segments.
              'responsive'   : true,
              'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
              'textFontSize' : 17,    // Set font size as desired.
              'segments'     :  <?php echo $spinner_data_json;?>,       // Define segments including colour and text.
              'animation' :          // Specify the animation to use.
              {
                  'type'     : 'spinToStop',
                  'duration' : {{$Camping->spinner_time}},     // Duration in seconds.
                  'spins'    : 8,     // Number of complete spins.
                  'callbackFinished' : alertPrize
              }
          });

          // Vars used by the code in this page to do power controls.
          var wheelPower    = 0;
          var wheelSpinning = false;

          // -------------------------------------------------------
          // Function to handle the onClick on the power buttons.
          // -------------------------------------------------------
          function powerSelected(powerLevel)
          {
              // Ensure that power can't be changed while wheel is spinning.
              if (wheelSpinning == false)
              {
                  // Reset all to grey incase this is not the first time the user has selected the power.
                  document.getElementById('pw1').className = "";
                  document.getElementById('pw2').className = "";
                  document.getElementById('pw3').className = "";

                  // Now light up all cells below-and-including the one selected by changing the class.
                  if (powerLevel >= 1)
                  {
                      document.getElementById('pw1').className = "pw1";
                  }

                  if (powerLevel >= 2)
                  {
                      document.getElementById('pw2').className = "pw2";
                  }

                  if (powerLevel >= 3)
                  {
                      document.getElementById('pw3').className = "pw3";
                  }

                  // Set wheelPower var used when spin button is clicked.
                  wheelPower = powerLevel;

                //   document.getElementById('spin_button').className = "clickable";
              }
          }

          // -------------------------------------------------------
          // Click handler for spin button.
          // -------------------------------------------------------
          function startSpin()
          {
              // Ensure that spinning can't be clicked again while already running.
              if (wheelSpinning == false)
              {
                  // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                  // to rotate with the duration of the animation the quicker the wheel spins.
                  if (wheelPower == 1)
                  {
                      theWheel.animation.spins = 3;
                  }
                  else if (wheelPower == 2)
                  {
                      theWheel.animation.spins = 8;
                  }
                  else if (wheelPower == 3)
                  {
                      theWheel.animation.spins = 15;
                  }

                  document.getElementById('spin_button').className = "";

                  // Begin the spin animation by calling startAnimation on the wheel object.
                  theWheel.startAnimation();

                  // Set to true so that power can't be changed and spin button re-enabled during
                  // the current animation. The user will have to reset before spinning again.
                  wheelSpinning = true;
              }
          }

          // -------------------------------------------------------
          // Function for reset button.
          // -------------------------------------------------------
          function resetWheel()
          {
              theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
              theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
              theWheel.draw();                // Call draw to render changes to the wheel.

              document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
              document.getElementById('pw2').className = "";
              document.getElementById('pw3').className = "";

              wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
          }

          // -------------------------------------------------------
          // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters
          // note the indicated segment is passed in as a parmeter as 99% of the time you will want to know this to inform the user of their prize.
          // -------------------------------------------------------
          function alertPrize(indicatedSegment)
          {
                console.log('pose');
                console.log(indicatedSegment);

                if (indicatedSegment.chances == 0 || indicatedSegment.chances < 0  ) {
                  swal({
                      title: "Network Forbidden",
                      text: "Due to network issue spin is not working please try again.",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      closeOnConfirm: false
                    },
                    function(isConfirm){
                      if (isConfirm) {
                          location.reload(true);
                        } else {
                            return false;
                        }
                    });
                    return;
                }

                if(playing == true){
                    document.getElementById('circleSound').pause();
                    playing= false;
                }
               
                document.getElementById('own').play();

                blast_fun();
              $('.award_text').html(indicatedSegment.text);
              $('.blast').show();

              if (indicatedSegment.image !='') {
                  $('.spinner_image_show').attr('src',indicatedSegment.image);
                  $('.spinner_image').attr('src',indicatedSegment.image);
              }else{
                $('.trophy_img').attr('src',"{{asset('frontend/spinner/wheel/trophy.png')}}");
                $('.spinner_image').attr('src',"{{asset('frontend/spinner/wheel/trophy.png')}}");
              }

              $('#spinner_id').val(indicatedSegment.id);
              $('#spinner_name').val(indicatedSegment.text);
              $('.spinner_name_text').html(indicatedSegment.text);
              $('#spinner_value').val(indicatedSegment.price);

              document.getElementById('own').play();
                      playing = true;

              setTimeout(() => {
                $('#confetti-canvas').hide();
              }, 2000);

              $(".start-btn-spin").removeAttr('disabled');

              // Do basic alert of the segment text. You would probably want to do something more interesting with this information.
            //   show_prize_msg("You have won " + indicatedSegment.text + " !");

          }

          //  function calculatePrize(after_angle, seg_angle)
          //     {
                  
          //         after_angle = after_angle +1;
          //         seg_angle = seg_angle - 2 ;
                  
          //         let stopAt = (after_angle + Math.floor((Math.random() * seg_angle)))  //  91 for 3rd becuase every sector is 45 degree
          //         console.log(stopAt);
          //         // Important thing is to set the stopAngle of the animation before stating the spin.
          //         theWheel.animation.stopAngle = stopAt;
           
          //         // May as well start the spin from here.
          //         theWheel.startAnimation();
          //     }

          function calculatePrize(degree, after_angle, seg_angle) {
              // Calculate the lessBound
              let lessBound = (after_angle - degree) + 10;
              console.log("Less Bound:", lessBound);

              // Generate a random number between lessBound and after_angle (inclusive)
              let stopAt = Math.floor(Math.random() * (after_angle - lessBound + 1)) + lessBound;

              if (stopAt >= lessBound && stopAt <= after_angle) {
                console.log("Stop at angle:", stopAt); // This will log a random number between lessBound and after_angle

                  // Set the stop angle for the wheel animation
                  theWheel.animation.stopAngle = stopAt;
              }
              // Start the wheel animation
              theWheel.startAnimation();
          }










          //--------------------------------------------------------
          
    function open_form_modal(){
      $('#FormModal').modal('show');
    }

      $("#spinner_form").on('submit',(function(e) {
        e.preventDefault();
        var name  = $('#name').val();
        var email  = $('#email').val();
        var whatsapp_number  = $('#whatsapp_number').val();
        var phone  = $('#phone').val();
        var address  = $('#address').val();
        var bike_model_id  = $('#bike_model_id').val();
 
        $('.form_submit_button').attr('disabled','disabled');
        $('#preloader').show();
        //get the action-url of the form
        var actionurl = e.currentTarget.action;

        //do your own request an handle the results
        $.ajax({
                url: actionurl,
                type: 'post',
                // dataType: 'application/json',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                  $('.form_submit_button').removeAttr('disabled');
                  if (data.message == 'Inserted') {
                    
                    swal({
                      title: "Success",
                      text: "<h4>Thank You For Submit Us Details</h4><span>Our Team Will be Contact You Soon </span> <p  style='margin:7px'><b>Helpline Number </b></p><a href='tel:{{$user->phone}}'><p><i class='fas fa-phone'></i> {{$user->phone}}</a></p>", 
                      html: true,
                      type: "success",
                      confirmButtonText: "Cool",
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Ok",
                    }, function(isConfirm) {
                        if (isConfirm) {
                          location.reload(true);
                        } else {
                            return false;
                        }
                    });
                    

                  } else if(data.message == 'AlreadyInserted'){
                    swal({
                      title: "Error!",
                      text: "<h2>Already Submitted</h2><p style='margin:7px'><b>Helpline Number</b></p><a href='tel:{{$user->phone}}'><p><i class='fas fa-phone'></i> {{$user->phone}}</a>",
                      html: true,
                      type: "error",
                      confirmButtonText: "Cool"
                    });
                  } else {
                    swal({
                      title: "Error!",
                      text: "Here's my error message!",
                      type: "error",
                      confirmButtonText: "Ok"
                    });
                  }
                  $('#preloader').hide();
                   
                }
        });
      }));


      function check_user_spinner_submit(){
        // $.ajax({
        //   url: "{{URL::to('u/spinner_form_check/post')}}",
        //   type: 'post',
        //   // dataType: 'application/json',
        //   data:  {
        //     id:''
        //   },
        //   headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        //   success: function(data) {
        //     if (data.message == 'AlreadyInserted') {
        //       swal({
        //         title: "Error!",
        //         text: "<h2>Already Submitted</h2><p style='margin:7px'><b>Helpline Number</b></p><a href='tel:{{$user->phone}}'><p><i class='fas fa-phone'></i> {{$user->phone}}</a>",
        //         html: true,
        //         type: "error",
        //         confirmButtonText: "Ok"
        //       });

        //       document.getElementById('error').play();
        //   playing = true;

        //     }else {
        //       $('#ReedemModal').modal('show');
        //     }
              
        //   }
        // });

        $('#ReedemModal').modal('show');

      }


      jQuery(".sticky_share_btn").click(function () {
        jQuery(".listing").fadeToggle(600);
      });
      jQuery(".form_take_screenshot").click(function () {
        $('#FormModal').modal('hide');
        $('#ReedemModal').modal('hide');
      });


                //
      @if (!empty($popup) && $popup->status == 'active')
        @if(!Session::get('popupShow'))
            //alert('fff');
            setTimeout(function(){ $('.newsShowPopupModal').modal('show');}, 1000);
            
        @else
            //alert('ddd');
            $('.newsShowPopupModal').modal('hide');
        @endif
      @endif

      function popupModalClose(){
          //alert('pop');
          @php
              Session::put('popupShow','show');
          @endphp
          $('.newsShowPopupModal').modal('hide');
      } 



          
      </script>
</body>
</html>
