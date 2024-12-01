<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      @if ($Camping->title_status == 'on')
      {{$Camping->title}}
      @else
      Prize Wheel
      @endif
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
  {{-- <link href="https://codepen.io/hexagoncircle/pen/vYxKLOa.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('adminAssets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frontend/award/css/style.css')}}">
    
    <link rel="stylesheet" href="{{asset('frontend/spinner/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/my-style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      /* Spinning animation */
      .is-spinning .spinner {
        transition: transform <?php echo $rotation_time;?>s cubic-bezier(0.1, -0.01, 0, 1);
      }
    </style>
</head>
<body class="front_background ">


      <div class="container-fluid camping_box">
        <div class="row my-2">
          <div class="col-md-12">
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

      <div class="main_box" @if($user->default_background == 'on') @else style="background:{{$user->background_color}}" @endif>
        

        <div class="deal-wheel">
          <ul class="spinner"></ul>
            <figure class="cap start-btn-spin" style="    background: white;
            border-radius: 50%;
            text-align: center;
            justify-content: center;
            align-items: center;
            display: flex;">

            <div  class="grim-reaper" data-reaction="dancing" xmlns="http://www.w3.org/2000/svg"></div>
            {{-- <svg class="grim-reaper" data-reaction="dancing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 582 653">
              <defs>
                <clipPath id="clip-path">
                  <circle class="cls-1" cx="295.6" cy="286.3" r="286.3"></circle>
                </clipPath>
                <clipPath id="clip-path-2">
                  <path class="cls-1" d="M460 250c0 130-126 222-151 209-39-22-194-110-194-239S280 54 356 54c33 1 104 66 104 196z"></path>
                </clipPath>
                <clipPath id="clip-path-3">
                  <path class="cls-1" d="M122 426l-100 7s28 161 167 156c37-2 69-27 66-31s-28 13-71-13c-58-35-62-119-62-119z"></path>
                </clipPath>
                <style>
                  .cls-1,
                  .cls-17 {
                    fill: none
                  }
            
                  .cls-4 {
                    fill: #141414
                  }
            
                  .cls-5 {
                    fill: #111010
                  }
            
                  .cls-6 {
                    fill: #fff
                  }
            
                  .cls-7 {
                    fill: #5c382b
                  }
            
                  .cls-9 {
                    fill: #232323
                  }
            
                  .cls-15 {
                    fill: #2d221e
                  }
            
                  .cls-16 {
                    fill: #4f2610;
                    opacity: .6;
                  }
            
                  .cls-17 {
                    stroke: #9b8029;
                    stroke-miterlimit: 10;
                    stroke-width: 2.5px
                  }
            
                  .cls-18 {
                    fill: #a7a9ad
                  }
            
                  .cls-20 {
                    fill: #fafafa
                  }
                </style>
              </defs>
              <circle id="BG" cx="295.6" cy="286.3" r="286.3" fill="#960b0a"></circle>
              <g data-animate="body">
                <g id="ROBE">
                  <path class="cls-4" d="M489 371s-9-1-18 6c-15 12-35 38-35 38l46 58s0-8-4-22c-4-15-5-58 2-73 2-5 9-7 9-7z"></path>
                  <path class="cls-5" d="M483 487c-3 0-8-1-5-26 1-6-3-14-4-43-2-48 15-47 15-47s22-2 2 59c-11 32-5 57-8 57zM168 464c0 37-27 67-27 67s-34-30-49-64c-9-21-12-65-2-68 34-11 78 28 78 65z"></path>
                </g>
                <g id="LEFT_ARM">
                  <path class="cls-6" d="M473 440l-2-1a1 1 0 010-1l5-24 7-26a1 1 0 011-1l3 1a1 1 0 010 1 133 133 0 00-9 25 171 171 0 00-4 25l-1 1z"></path>
                  <path class="cls-6" d="M472 439l2 1a1 1 0 001-1l8-24 8-25a1 1 0 00-1-1l-3-1a1 1 0 00-1 1 132 132 0 01-5 26 170 170 0 01-9 23v1z"></path>
                </g>
                <g id="RIGHT_ARM">
                  <path class="cls-6" d="M177 521l5-3a2 2 0 000-2l-22-49-27-49a2 2 0 00-2-1l-6 3a2 2 0 000 2c11 15 22 31 30 47a362 362 0 0120 50l2 2z"></path>
                  <path class="cls-6" d="M180 518l-5 3a2 2 0 01-2-1l-28-46-26-49a2 2 0 010-3l6-3a2 2 0 012 1c6 18 13 35 23 51a363 363 0 0030 45v2z"></path>
                </g>
                <path id="SCYTHE-SNATH" class="cls-7" d="M22 433l493-45a6 6 0 016 3 6 6 0 01-5 8L27 455z"></path>
              </g>
              <g clip-path="url(#clip-path)" id="ROBE-BOTTOM-CLIP-PATH">
                <g data-animate="body" id="ROBE-BOTTOM">
                  <path class="cls-4" d="M478 479c0-8 1-27-1-34-3-9 1-42 1-42l-36 4-6 8s-9 4-39-12c-20-10-70 52-70 52s74 93 105 90c6-1 21-1 16-10-4-7 11-37 30-44 4-1 5-3 6-6 0 0-6 4-6-6z"></path>
                  <path class="cls-9" d="M381 396c-18-20-50-3-85-11-25-5-36 4-41 21l-14 1c-20 3-39 30-49 48l-13-18-37 5s8 19 4 35c-8 32 8 73 8 73h30v10h18c-24 28 51 22 108 22 61 0 110 13 116-7 17-50-3-133-45-179z"></path>
                </g>
              </g>
              <g data-animate="body">
                <path id="HOOD" class="cls-5" d="M460 250c0 130-126 222-151 209-39-22-194-110-194-239S280 54 356 54c33 1 104 66 104 196z"></path>
                <g id="TIE" clip-path="url(#clip-path-2)">
                  <path d="M352 431a120 120 0 00-17-38 19 19 0 009-18c-1-10-40-4-39 6 2 9 10 15 19 15-1 9-4 24-7 33-4 12-21 30-21 30l25 55a4 4 0 007 2l25-31s5-29-1-54z" fill="#da193f"></path>
                  <path d="M301 460s13 1 35-13a47 47 0 0016-16 59 59 0 012 14l1 16z" fill="#bc0f39"></path>
                </g>
                <g id="SCYTHE-2">
                  <path class="cls-18" d="M122 426l-100 7s28 161 167 156c37-2 69-27 66-31s-28 13-71-13c-58-35-62-119-62-119z"></path>
                  <g clip-path="url(#clip-path-3)">
                    <path class="cls-20" d="M116 588l-32 7 44-142 32-7-44 142zM133 595l-8 2 44-142 8-2-44 142z"></path>
                    <path d="M255 558s-50 29-108-1c-64-34-72-113-72-113" stroke="#969799" stroke-miterlimit="10" stroke-width="2.5" fill="none"></path>
                  </g>
                  <path class="cls-7" d="M10 434l121-10 4 18-123 13a11 11 0 01-12-8 11 11 0 0110-13z"></path>
                </g>
                <g id="KEY">
                  <path d="M244 570a26 26 0 011 4 30 30 0 01-3 17c-2 5-7 9-12 9a14 14 0 01-1 1c-5 0-9-3-13-6a30 30 0 01-7-17c-1-13 5-22 15-24 8-1 12 3 16 5a33 33 0 01-5 1h-5c-9-3-15 8-14 18a23 23 0 005 12c3 3 6 4 8 4s6-3 7-6c2-4 3-9 2-14z" fill="#9b8029"></path>
                  <path class="cls-18" d="M210 619h13v32h-12a1 1 0 01-1-1v-31z" transform="rotate(19 217 635)"></path>
                  <path d="M217 590h16a12 12 0 0112 13v26a1 1 0 01-1 2h-38a1 1 0 01-1-2v-26a12 12 0 0112-13z" transform="rotate(19 225 611)" fill="#1e1e1e"></path>
                </g>
                <g id="LEFT_HAND">
                  <path class="cls-6" d="M492 411c-5-2 2-10-6-17s-4-14 1-17c6-3 14 1 15 10s9 5 10 10-12 17-20 14zM526 419h1a1 1 0 000-2l-9-12a3 3 0 00-4-1l-17 10a3 3 0 00-1 4l5 14a1 1 0 001 1l2-1a1 1 0 000-1 29 29 0 01-3-7v-6c1 0 4 0 6 4l2 7a1 1 0 001 1l2-1a1 1 0 000-2 24 24 0 01-3-6c-2-5-3-6-2-7s5 1 7 5l3 6a1 1 0 001 1l2-1a1 1 0 000-1 62 62 0 01-5-8c-1-3-2-5-1-6s4 0 7 3l3 6a1 1 0 002 0zM489 428h-2v-1a35 35 0 002-6 60 60 0 001-8l3 1a27 27 0 00-2 7l-1 7h-1zM504 444h-2a22 22 0 000-5v-5l2-1v1a17 17 0 000 5v5zM513 441h-2l-1-1a19 19 0 001-4l-1-5h1l2-1a15 15 0 000 5 93 93 0 000 6zM521 437h-3v-1a19 19 0 000-4v-5l2-1 1 1a15 15 0 00-1 4l1 5v1z"></path>
                  <path class="cls-6" d="M528 429h-2v-1-3l-1-4 1-1h2a15 15 0 000 5 14 14 0 001 3l-1 1zM499 451l-1-1a13 13 0 002-3l2-2h1l1 1c1 0 1 0 0 0a10 10 0 00-2 2l-2 3h-1zM509 449l-2-1v-1a13 13 0 002-2l2-3s0-1 0 0h2a10 10 0 00-2 3l-2 4zM518 446h-2v-1a13 13 0 001-3l1-3h2a10 10 0 00-1 3l-1 4zM526 438l-2-1a13 13 0 001-4l1-3h2a10 10 0 00-1 4v3l-1 1zM493 436l-3 2v-1l-1-3-2-4v-1h3a10 10 0 001 4l2 3zM496 443a22 22 0 01-2 1l-1-2a6 6 0 00-1-2v-1l1-1h1a10 10 0 001 3 8 8 0 001 2z"></path>
                </g>
                <g id="RIGHT_HAND">
                  <path class="cls-6" d="M106 435c9 1 2-16 19-21s-31-17-36-10 3 31 17 31zM49 426l-1-2a2 2 0 010-2l22-12a5 5 0 017 2l17 26a5 5 0 010 5l-18 18a1 1 0 01-2 0l-1-2a1 1 0 010-1l10-9c3-5 4-7 3-9s-6-2-11 3l-8 8a1 1 0 01-3 0l-1-2a1 1 0 010-2 38 38 0 0010-8c5-5 8-7 7-9s-8-1-13 3l-9 7a1 1 0 01-2 0l-2-2a1 1 0 010-2 102 102 0 0012-8c5-3 8-6 7-8s-7-2-13 0l-9 6a2 2 0 01-2 0zM96 463l4 1a1 1 0 001 0 58 58 0 012-11 98 98 0 013-12 1 1 0 00-1-1h-4a1 1 0 000 1 45 45 0 01-2 11l-3 11zM64 476l3 2a1 1 0 001 0 36 36 0 013-8l3-6v-1l-2-2a1 1 0 00-1 0 28 28 0 01-3 8l-4 7zM53 466l3 1a1 1 0 001 0 32 32 0 013-7l4-7h-1l-2-3a1 1 0 00-1 1 25 25 0 01-3 7l-4 7a1 1 0 000 1zM44 455l4 1a32 32 0 013-7l4-7-1-1-2-2a1 1 0 00-1 1 25 25 0 01-3 7l-4 7a1 1 0 000 1zM39 438l3 1a1 1 0 001 0l2-5c3-4 3-7 3-7l-3-2a25 25 0 01-3 7 23 23 0 01-4 5l1 1zM66 491l3-1s1 0 0 0a21 21 0 01-2-6l-1-5h-4a16 16 0 012 6l1 6h1zM54 481l3-1h1a21 21 0 01-2-6v-5l-1-1h-3a16 16 0 011 6v6l1 1zM42 471h4a21 21 0 010-6l1-5-1-1-2-1h-1a16 16 0 010 6l-1 6v1zM35 452l3 1 1-1a21 21 0 011-5l1-6-3-2-1 1a16 16 0 010 6l-2 5v1zM86 473l3 4h1s0-2 3-4l6-5v-1l-3-2h-1a16 16 0 01-4 5l-5 3zM76 481a35 35 0 003 3l2-2a10 10 0 014-3l1-1-2-3h-1a17 17 0 01-4 4 12 12 0 01-3 2z"></path>
                  <path class="cls-9" id="ROBE-4" data-name="ROBE" d="M90 399s25-19 58 0c17 10 23 21 23 21l-42 4-6-7c-11-15-33-18-33-18z"></path>
                </g>
              </g>
              <g data-animate="head">
                <g id="SKULL_TOP">
                    <path class="cls-6" d="M299 218a31 31 0 01-8 3 1 1 0 001 2 33 33 0 008-3 1 1 0 001-2 1 1 0 00-2 0zM320 186a1 1 0 00-1 1 41 41 0 01-13 27 1 1 0 000 2 1 1 0 001 0 1 1 0 001 0 44 44 0 0013-29 1 1 0 00-1-1z"></path>
                    <path class="cls-6" d="M415 186c7-21 2-35-3-43-10-19-20-25-38-26-14-2-13 2-24-1a166 166 0 00-38-3h-2l-2 1a35 35 0 00-13-4c-11-1-20 3-28 11-5 5-13 11-21 13s-38 11-41 25c-1 8-3 23-3 35s3 26 7 42a33 33 0 0028 24c7 1 34-3 46 17 4 5 5 10 9 12 3 0 10 1 14-9a3 3 0 015 0c0 1 3 6 11 6 6 0 10-3 11-8a3 3 0 015 0c0 5 3 7 9 7 7 0 10-4 11-9a2 2 0 013-2 3 3 0 012 2c0 1 3 8 13 5 8-3 9-18 9-18s1 2 6 2 15-5 21-21c10-26-4-37 3-58zm-127 41c-18-2-32-21-30-42s19-38 37-37 33 21 31 43-19 38-38 36zm62 17c-5 2-13-5-13-5s-6 9-11 7 4-42 12-42 17 38 12 40zm27-21c-14 3-29-11-32-31s6-35 20-37 29 8 33 28-6 38-21 40z"></path>
                    <path class="cls-6" d="M391 178a1 1 0 00-1 1c2 14 0 26-7 33a13 13 0 01-11 4 1 1 0 00-1 1 1 1 0 001 1 14 14 0 002 1 15 15 0 0011-5c7-8 10-21 7-35a1 1 0 00-1-1z"></path>
                  </g>
                <g id="MUSTACHE">
                  <path class="cls-15" d="M339 253v8a1 1 0 01-1 1l-27 1a1 1 0 010-1l27-9a1 1 0 011 0zM342 254l-1 7a1 1 0 001 1l28 2a1 1 0 000-1l-27-10a1 1 0 00-1 1z"></path>
                </g>
                <g id="AVIATORS">
                  <path class="cls-16" d="M235 185c-16 27 7 73 43 70 37-3 67-62 55-78s-83-19-98 8z"></path>
                  <path class="cls-17" d="M235 185c-16 27 7 73 43 70 37-3 67-62 55-78s-83-19-98 8z"></path>
                  <path class="cls-16" d="M424 188c17 20-7 66-37 64-31-3-50-62-39-76s63-4 76 12z"></path>
                  <path class="cls-17" d="M424 188c17 20-7 66-37 64-31-3-50-62-39-76s63-4 76 12z"></path>
                  <path class="cls-17" d="M286 165s15-1 53 1 51 6 51 6M335 181s0-5 5-5 5 5 5 5"></path>
                </g>
                <g data-animate="jaw" id="SKULL_BOTTOM_CIGAR">
                  <path id="SKULL_BOTTOM" class="cls-6" d="M257 274c-3 0 0 1 1 3 7 8 19 11 6 68-3 16 33 38 68 41 32 2 43-8 57-35 11-22 9-57-1-64-13-9-42 14-48 14s-1-6-10-6c-12-1-22 9-37 7-15-1-14-16-22-24-4-5-10-5-14-4z"></path>
                  <g id="CIGAR">
                    <path d="M322 296a56 56 0 00-44-7c-13 3-19 8-19 8a59 59 0 0021 20c10 5 5 13 7 14s11-15 14-21 13-12 13-12z" fill="#755e51"></path>
                    <path d="M281 306c8 9 13 18 8 23s-13 4-22-4-13-22-8-28 15 1 22 9z" fill="#6d5241"></path>
                  </g>
                </g>
              </g>
              <path data-animate="body" id="HOOD_FRONT" class="cls-9" d="M356 54s-100 18-131 96c-40 100 86 310 86 310s-108-45-166-137a432 432 0 01-36-71c-2-6-16 46-23 23-9-33 7-88 31-126 65-103 239-95 239-95z"></path>
            </svg> --}}
            Spin
            </figure>
            <div class="ticker"></div>
            {{-- <button class="btn-spin">Spin the wheel</button> --}}
        </div>
      </div>

      <div class="share_button">
        {{-- <a href="https://wa.me/?text={{URL::to('/')}}" target="_blank">
          <span><i class="fab fa-whatsapp"></i></span>
        </a> --}}
        <div class="sticky_share_btn">
          <div class="fixed_share">
            <span class="share-toggle">
              <i class="fa fa-share-alt"></i>
            </span>
            <ul class="listing">
              <li class="facebook">
                <a href="http://www.facebook.com/share.php?u={{url()->current()}}" target="_blank">
                  <i class="fab fa-facebook"></i>
                </a>
              </li>
              
              <li class="whatsapp">
                <a href="https://wa.me/?text={{url()->current()}}" target="_blank">
                  <i class="fab fa-whatsapp"></i>
                </a>
              </li>
            </ul>
            
          </div>
        </div>
      </div>

      {{-- <div class="click_to_spain">
        <h3>Click to Spin Popup</h3>
      </div> --}}

      
      {{-- <div class="row">
          <div class="col-md-3">
              
          </div>
          <div class="col-md-6">
              
          </div>
          <div class="col-md-3">
              
          </div>
      </div> --}}


    <div class="blast" style="display: none">
      <div class="content">
          <div class="trophy">
              <img src="https://i.ibb.co/kVZ3CN6/trophy.png" class="trophy_img" alt="trophy">
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

    <audio  id="player" controls>
      <source src="{{asset('mp3/wheel2.wav')}}" type="audio/mpeg">
        
    </audio>
    <audio  id="error" controls>
      <source src="{{asset('mp3/error.mp3')}}" type="audio/mpeg">
        
    </audio>
    <audio  id="own" controls>
      <source src="{{asset('mp3/won.mp3')}}" type="audio/mpeg">
        
    </audio>
{{-- 
    <audio id="player" src="{{asset('mp3/wheel2.wav')}}"> </audio>
    <audio id="error" src="{{asset('mp3/error.mp3')}}"> </audio>
    <audio id="own" src="{{asset('mp3/won.mp3')}}"> </audio>
 --}}

      
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

  {{-- <div class="modal fade" id="ReedemModal" tabindex="-1" role="dialog" aria-labelledby="ReedemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ReedemModalLabel">Reedem Gift</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h5>If you have screen then please click on Yes button and if have not the click Take Screenshot button.</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <button  class="btn btn-warning take_screenshot" data-dismiss="modal" aria-label="Close">Take Screenshot</button>
              </div>
              <div class="col-md-6 float-right">
                <button class="btn btn-success" onclick="open_form_modal()">Yes</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div> --}}


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
                    <select name="bike_model_id" id="bike_model_id" class="form-control">
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
                <input type="file" name="screenshot" class="form-control" @if (!empty($FormFields) && $FormFields->screenshot == 'on') required @endif id="screenshot" placeholder="Screenshot">
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


    
  <!-- Import Js Files -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script  src="{{asset('frontend/award/js/blast.js')}}"></script>


  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

  @php
      //print_r($spinner_data_json);
  @endphp
      <script>
          /**
 * Prize data will space out evenly on the deal wheel based on the amount of items available.
 * @param text [string] name of the prize
 * @param color [string] background color of the prize
 * @param reaction ['resting' | 'dancing' | 'laughing' | 'shocked'] Sets the reaper's animated reaction
 */
// const prizes = [
//   {
//     text: "10% Off Sticker Price",
//     color: "hsl(197 30% 43%)",
//     reaction: "dancing",
//     price:"10"
//   },
//   { 
//     text: "Free Car",
//     color: "hsl(200 58% 39%)",
//     reaction: "shocked",
//     price:"10"
//   },
//   { 
//     text: "No Money Down",
//     color: "hsl(43 74% 66%)",
//     reaction: "shocked",
//     price:"10" 
//   },
//   {
//     text: "Half Off Sticker Price",
//     color: "hsl(27 87% 67%)",
//     reaction: "shocked",
//     price:"10"
//   },
//   {
//     text: "Free DIY Carwash",
//     color: "hsl(12 76% 61%)",
//     reaction: "dancing",
//     price:"10"
//   },
//   {
//     text: "Eternal Damnation",
//     color: "hsl(500 60% 52%)",
//     reaction: "laughing",
//     price:"10"
//   },
//   {
//     text: "Used Travel Mug",
//     color: "hsl(91 43% 54%)",
//     reaction: "laughing",
//     price:"10"
//   },
//   {
//     text: "One Solid Hug",
//     color: "hsl(140 36% 74%)",
//     reaction: "dancing",
//     price:"10"
//   }
// ];


const prizes = <?php print_r($spinner_data_json);?>;
let skip_data = <?php print_r($spinner_skip_json);?>;
 console.log(skip_data);

const wheel = document.querySelector(".deal-wheel");
const spinner = wheel.querySelector(".spinner");
const trigger = wheel.querySelector(".start-btn-spin");
const ticker = wheel.querySelector(".ticker");
const reaper = wheel.querySelector(".grim-reaper");
const prizeSlice = 360 / prizes.length;
const prizeOffset = Math.floor(180 / prizes.length);
const spinClass = "is-spinning";
const selectedClass = "selected";
const spinnerStyles = window.getComputedStyle(spinner);
let tickerAnim;
let rotation = 0;
let currentSlice = 0;
let prizeNodes;

const createPrizeNodes = () => {
  prizes.forEach(({ text, color, reaction,image }, i) => {
    const rotation = ((prizeSlice * i) * -1) - prizeOffset;
    spinner.insertAdjacentHTML(
        "beforeend",
        `<li class="prize prize_data" data-reaction=${reaction} style="--rotate: ${rotation}deg">
          <span class="text">${text}</span>
          
        </li>`
      );
    
    
  });
};

const createConicGradient = () => {
  spinner.setAttribute(
    "style",
    `background: conic-gradient(
      from -90deg,
      ${prizes
        .map(({ color }, i) => `${color} 0 ${(100 / prizes.length) * (prizes.length - i)}%`)
        .reverse()
      }
    );`
  );
};


const setupWheel = () => {
  createConicGradient();
  createPrizeNodes();
  prizeNodes = wheel.querySelectorAll(".prize_data");
  console.log(prizeNodes);
};

const spinertia = (min, max) => {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
};

const runTickerAnimation = () => {
  // https://css-tricks.com/get-value-of-css-rotation-through-javascript/
  const values = spinnerStyles.transform.split("(")[1].split(")")[0].split(",");
  const a = values[0];
  const b = values[1];  
  let rad = Math.atan2(b, a);
  
  if (rad < 0) rad += (2 * Math.PI);
  
  const angle = Math.round(rad * (180 / Math.PI));
  const slice = Math.floor(angle / prizeSlice);
  
  if (currentSlice !== slice) {
    
    ticker.style.animation = "none";
    setTimeout(() => ticker.style.animation = null, 10);
    currentSlice = slice;
  }

  tickerAnim = requestAnimationFrame(runTickerAnimation);
 
};

const selectPrize = () => {
   
  const selected = Math.floor(rotation / prizeSlice);
  console.log( prizes[selected]);
  prizeNodes[selected].classList.add(selectedClass);

  document.getElementById('player').pause();
  playing = false;
  $(this).text("restart sound");

  $('#confetti-canvas').show();
  blast_fun();
  $('.award_text').html(prizes[selected].text);
  $('.blast').show();

  if (prizes[selected].image !='') {
      $('.spinner_image_show').attr('src',prizes[selected].image);
      $('.spinner_image').attr('src',prizes[selected].image);
  }else{
    $('.trophy_img').attr('src','https://i.ibb.co/kVZ3CN6/trophy.png');
    $('.spinner_image').attr('src','https://i.ibb.co/kVZ3CN6/trophy.png');
  }

  $('#spinner_id').val(prizes[selected].id);
  $('#spinner_name').val(prizes[selected].text);
  $('.spinner_name_text').html(prizes[selected].text);
  $('#spinner_value').val(prizes[selected].price);

  document.getElementById('own').play();
          playing = true;

  // setTimeout(() => {
  //   $('.blast').hide();
  //   $('#confetti-canvas').hide();
  //   $('#FormModal').modal('show');
  //   $('#spinner_name').val(prizes[selected].text);
  //   $('#spinner_value').val(prizes[selected].price);
  // }, 4000);

  


  
  reaper.dataset.reaction = prizeNodes[selected].dataset.reaction;

  setTimeout(() => {
    $('#confetti-canvas').hide();
  }, 2000);

  $(".start-btn-spin").removeAttr('disabled');
  
};

trigger.addEventListener("click", () => {
//   if (reaper.dataset.reaction !== "resting") {
//     reaper.dataset.reaction = "resting";
//   }

if($(".start-btn-spin").attr('disabled')){
     return;
}

$(".start-btn-spin").attr('disabled','disabled');


swal({
    title: "Are you sure?",
    text: "If you click on 'Yes' button it will reduce your spin limit",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
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
                document.getElementById('player').play();
                  playing = true;
                  $(this).text("stop sound");

                  if (reaper.dataset.reaction !== "resting") {
                    reaper.dataset.reaction = "resting";
                  }

                trigger.disabled = true;
                rotation = Math.floor(Math.random() * 360 + spinertia(2000, 5000));

                console.log(rotation);

                prizeNodes.forEach((prize) =>{
                  prize.classList.remove(selectedClass);
                  
                });
                wheel.classList.add(spinClass);
                spinner.style.setProperty("--rotate", rotation);
                ticker.style.animation = "none";
                runTickerAnimation();

                swal.close();
            }
            $('.confirm').removeAttr('disabled');
            
          },
        error: function(err) {
            reject(err) // Reject the promise and go to catch()
        }
    });


    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
 });

          
});

spinner.addEventListener("transitionend", () => {
  cancelAnimationFrame(tickerAnim);
  trigger.disabled = false;
  trigger.focus();
  rotation %= 360;

  const selected = Math.floor(rotation / prizeSlice);

  if (skip_data.includes(prizes[selected].text)) {

    document.getElementById('player').play();
          playing = true;
          $(this).text("stop sound");

    trigger.disabled = true;
    rotation = Math.floor(Math.random() * 360 + spinertia(2000, 5000));
    prizeNodes.forEach((prize) =>{
      prize.classList.remove(selectedClass);
      
    });
    wheel.classList.add(spinClass);
    spinner.style.setProperty("--rotate", rotation);
    ticker.style.animation = "none";
    runTickerAnimation();
    
  }

  selectPrize();
  wheel.classList.remove(spinClass);
  spinner.style.setProperty("--rotate", rotation);
  
});

setupWheel();



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
      // $('.click_to_spain h3').circleType({radius: 160, dir:-1});


      $(document).ready(function(){
            // $(document).bind("contextmenu",function(e){
            //     return false;
            // });
            // document.onkeydown = (e) => {
            //     if (e.key == 123) {
            //         e.preventDefault();
            //     }
            //     if (e.ctrlKey && e.shiftKey && e.key == 'I') {
            //         e.preventDefault();
            //     }
            //     if (e.ctrlKey && e.shiftKey && e.key == 'C') {
            //         e.preventDefault();
            //     }
            //     if (e.ctrlKey && e.shiftKey && e.key == 'J') {
            //         e.preventDefault();
            //     }
            //     if (e.ctrlKey && e.key == 'U') {
            //         e.preventDefault();
            //     }
            // };
      });


      	
    function numOnly(selector) {
        const numericValue = selector.value.replace(/[^0-9]/g, '');
        $('.form_submit_button').attr('disabled','disabled');
        if (numericValue.length !== 10) {
            const errorMessageSpan = document.getElementById("phone_error");
            errorMessageSpan.textContent = 'Enter Valid 10 Digit Number';
            selector.value = numericValue;
        } else {
            const errorMessageSpan = document.getElementById("phone_error");
            errorMessageSpan.textContent = '';
            selector.value = numericValue;
            $('.form_submit_button').removeAttr('disabled');
        }
    }
      	
    function wpNumOnly(selector) {
        const numericValue = selector.value.replace(/[^0-9]/g, '');
        $('.form_submit_button').attr('disabled','disabled');
        if (numericValue.length !== 10) {
            const errorMessageSpan = document.getElementById("wp_phone_error");
            errorMessageSpan.textContent = 'Enter Valid 10 Digit Number';
            selector.value = numericValue;
        } else {
            const errorMessageSpan = document.getElementById("wp_phone_error");
            errorMessageSpan.textContent = '';
            selector.value = numericValue;
            $('.form_submit_button').removeAttr('disabled');
        }
    }



      </script>
</body>
</html>