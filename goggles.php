<?php include("headermain.php"); ?>
  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">
      
              <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand" style="background-color: #0ddbb9;">
              <a href="backoffice">
                <!--<svg
                  class="brand-icon"
                  xmlns="http://www.w3.org/2000/svg"
                  preserveAspectRatio="xMidYMid"
                  width="30"
                  height="33"
                  viewBox="0 0 30 33"
                >
                  <g fill="none" fill-rule="evenodd">
                    <path
                      class="logo-fill-red"
                      fill="#ff0000"
                      d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                    />
                    <path class="logo-fill-yellow" fill="#00ff90" d="M11 4v25l8 4V0z" />
                  </g>
                </svg>-->
                <span class="brand-name">AdPacer</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                  <li>
                    <a class="sidenav-item-link" href="backoffice">
                      <i class="fa fa-dashboard"></i>
                      <span class="nav-text">Dashboard</span> <!--i class="fa fa-chevron-down"> </i-->
                    </a>
                  </li>
                  <li  class="has-sub active" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#ui-elements"
                      aria-expanded="false" aria-controls="ui-elements">
                      <i class="fa fa-list"></i>
                      <span class="nav-text">Advertize</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="ui-elements"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                        
                        <li  class="has-sub active" >
                          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
                            aria-expanded="false" aria-controls="components">
                            <i class="fa fa-list"></i>&nbsp;&nbsp;
                            <span class="nav-text">Ad Campaigns</span> <b class="caret"></b>
                          </a>
                          <ul  class="collapse"  id="components">
                            <div class="sub-menu">
                              
                              <li class="active">
                                
                                <a href="googs"><i class="fa fa-google"></i>&nbsp;&nbsp; Google</a>
                              </li>
                              
                              <li >
                                
                                <a href="facebees"><i class="fa fa-facebook"></i>&nbsp;&nbsp; Facebook</a>
                              </li>
                              
                              <li >
                                
                                <a href="twits"><i class="fa fa-twitter"></i>&nbsp;&nbsp; Twitter</a>
                              </li>
                              
                              <li >
                                <a href="#">#</a>
                              </li>
                              
                            </div>
                          </ul>
                        </li>
                        
                      </div>
                    </ul>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="sme">
                      <i class="fa fa-users"></i>
                      <span class="nav-text">Media Engagements</span> <b class="caret"></b>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="vt">
                      <i class="fa fa-video-camera"></i>
                      <span class="nav-text">Video Traffic</span></b>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="sms">
                      <i class="fa fa-paper-plane"></i>
                      <span class="nav-text">SMS Promotionals</span> <b class="caret"></b>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="web">
                      <i class="fa fa-spinner"></i>
                      <span class="nav-text">Web Apps</span> <b class="caret"></b>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="ct">
                      <i class="fa fa-line-chart"></i>
                      <span class="nav-text">Analytics</span> <b class="caret"></b>
                    </a>
                  </li>
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="settings">
                      <i class="fa fa-gears"></i>
                      <span class="nav-text">Settings</span> <b class="caret"></b>
                    </a>
                  </li>
              </ul>

            </div>

            <hr class="separator" />

            <!--<div class="sidebar-footer">
              <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                  Cpu Uses <span class="float-right">40%</span>
                </h6>
                <div class="progress progress-xs">
                  <div
                    class="progress-bar active"
                    style="width: 40%;"
                    role="progressbar"
                  ></div>
                </div>
                <h6 class="text-uppercase">
                  Memory Uses <span class="float-right">65%</span>
                </h6>
                <div class="progress progress-xs">
                  <div
                    class="progress-bar progress-bar-warning"
                    style="width: 65%;"
                    role="progressbar"
                  ></div>
                </div>
              </div>
            </div>-->
          </div>
        </aside>

      

      <div class="page-wrapper">
        <?php include("adminheader.php"); ?>
        <div class="content-wrapper">
          <div class="content">

            <div class="row" style="display: none;"><div class="col-12">
              <?php 

                $code = $_GET["code"];
                  
                $_SESSION["mycode"] = $code;


                //Get Auth Code
                if(isset($_POST["sendo"])){
                            
                  $scope = "https://www.googleapis.com/auth/adwords";
                  $endpoint = "https://accounts.google.com/o/oauth2/v2/auth?";
                  $redirect_url = "https://www.adpacer.com/admin/googs";
                  $client_id = "258852261669-jcf1i8dds2l4rs4jldu5kfdt29fbcte3.apps.googleusercontent.com";
                  $client_secret = "G2zC1Zc1x9Y9yH6P0MxoJpah";
                  $access_type = "offline"; 
                  $state = "state_parameter_passthrough_value"; 
                  $include_granted_scopes = "true"; 
                  $login_hint = "jaylovegh@gmail.com"; 
                  $prompt = "consent";
                  $response_type = "code";
                  //$servhost = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
                  
                  $buildguys = "client_id={$client_id}&redirect_uri={$redirect_url}&scope={$scope}&access_type={$access_type}&state={$state}&include_granted_scopes={$include_granted_scopes}&login_hint={$login_hint}&prompt={$prompt}&response_type={$response_type}";
                  $urlendo = $endpoint.$buildguys;
                  header("Location: ".$urlendo);
                    
                }


                //Exchange Auth Code for Token

                if(isset($_POST["sen"])){
                  $codi = $_POST["codi"];
                  
                  if(empty($codi)){
                      echo "<script>alert('Please ensure there is a return code to proceed')</script>";
                      echo "<script>window.location='https://www.adpacer.com/admin/googs'</script>";
                  }else{
                      $client_id = "258852261669-jcf1i8dds2l4rs4jldu5kfdt29fbcte3.apps.googleusercontent.com";
                      $client_secret = "G2zC1Zc1x9Y9yH6P0MxoJpah";
                      $redirect_url = "https://www.adpacer.com/admin/googs";
                      $grant_type = "authorization_code";
                      $tokenurl = "https://accounts.google.com/o/oauth2/token?";
                      $scope = "https://www.googleapis.com/auth/adwords";
                      $getokes = "code={$codi}&scope={$scope}&client_id={$client_id}&client_secret={$client_secret}&redirect_uri={$redirect_url}&grant_type={$grant_type}";
                      //GET /oauthplayground/?code=4/0AY0e-g4x--VT13qMBaDsqygtIoZTcBOTjvkrpYdp9AOvZ-UJ2bkI7VWfDIZFA5YRkPXRnA&scope=https://www.googleapis.com/auth/adwords
                      
                      $curl = curl_init();

                      curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://accounts.google.com/o/oauth2/token",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS =>"{$getokes}",
                      CURLOPT_HTTPHEADER => array(
                      "Content-Type: application/x-www-form-urlencoded"
                      ),
                      ));

                      $response = curl_exec($curl);

                      curl_close($curl);

                      file_put_contents("maintoken.json", $response);
                      file_put_contents("refreshtoken.json", $response);
                      
                      echo "<script>window.location='https://www.adpacer.com/admin/googs'</script>";
                  }
                  
                }


                //Main token and refresh token

                  $response = file_get_contents("https://www.adpacer.com/admin/maintoken.json");
                  $reftok = json_decode($response, true);
                  $arrtok = $reftok["access_token"];
                  $reftoken = $reftok["refresh_token"]; //use for refreshing access_token
                  
                  $resreftok = file_get_contents("https://www.adpacer.com/admin/refreshtoken.json");
                  $tokri = json_decode($resreftok, true);
                  $myarrtok = $tokri["access_token"]; //use for api calls
                  $coun = $tokri["expires_in"];
                          
                  $_SESSION["toki"] = $coun;


                  if(isset($_POST["sena"])){
                            
                    $refee = $_POST["refi"];
                    $client_secret = "G2zC1Zc1x9Y9yH6P0MxoJpah";
                    $grant_type= "refresh_token";
                    $client_id = "258852261669-jcf1i8dds2l4rs4jldu5kfdt29fbcte3.apps.googleusercontent.com";
                    $getokes = "client_secret={$client_secret}&grant_type={$grant_type}&refresh_token={$refee}&client_id={$client_id}";
                    
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://accounts.google.com/o/oauth2/token",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS =>"{$getokes}",
                    CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                    ),
                    ));

                    $resp = curl_exec($curl);

                    curl_close($curl);

                    file_put_contents("refreshtoken.json", $resp);
                    
                    //$urep = json_decode($resp, true);
                    
                    
                  }


              ?>
            </div></div>
            

            <div class="row">
              <div class="col-12"> 
                  <!-- Recent Order Table -->
                  <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                      <a href="#">Advertize</a>
                    </li>
                    <li class="breadcrumb-item">
                      <a href="#">Ad Campaigns</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Google</li>
                  </ol>
                </nav>

                <?php 
                if($_SESSION["username"] == "boss" && $_SESSION["password"] == "echo"){

                  echo '
                  <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                  <h2>Get New Token</h2>
                </div>
                <div class="card-body">
                    <form method="post" class="form-inline" action="googs">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="text" name="codi" class="form-control" id="inlineFormInputGroupUsername2" value="'.$_SESSION["mycode"].'" placeholder="Refresh Token" readonly />
                </div>
                <button type="submit" name="sendo" class="btn btn-primary mb-2">Get Auth Code</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" name="sen" class="btn btn-primary mb-2">Get New Token</button>
              </form>
              </div>
              </div>
                  ';

                }
              ?>
              <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                  <h2>Get Refresh Token</h2>
                </div>
                <div class="card-body">
                  <form method="post" class="form-inline" action="googs">
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                      </div>
                      <input type="text" name="refi" class="form-control" value="<?php echo $reftoken; ?>" id="inlineFormInputGroupUsername2" placeholder="Refresh Token" readonly />
                    </div>
                    <button type="submit" name="sena" class="btn btn-primary mb-2">Refresh</button>
                  </form>
                </div>
              </div>
              </div>

              <div class="col-md-6 col-xl-4">
                <div class="card py-3 mb-4">
                  <div class="card-body">
                    <h5 class="card-title text-primary">New Ad Customer</h5>
                    <p class="card-text pb-4 pt-1">Create a new Google Ad Customer</p>
                    <a href="createcustomer" class="btn btn-outline-primary">Create Customer</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card py-3 mb-4">
                  <div class="card-body">
                    <h5 class="card-title text-primary">New Ad Campaign (Full)</h5>
                    <p class="card-text pb-4 pt-1">Create a new Google Ad Campaign</p>
                    <a href="facebees" class="btn btn-outline-primary">Create Campaign</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card py-3 mb-4">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Get Accessible List</h5>
                    <p class="card-text pb-4 pt-1">Get all accessible customers </p>
                    <a href="twits" class="btn btn-outline-primary">Access Platform</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card py-3 mb-4">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Ad Campaign (Singular)</h5>
                    <p class="card-text pb-4 pt-1">Create Ad Campaign step-wise </p>
                    <a href="twits" class="btn btn-outline-primary">Access Platform</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card py-3 mb-4">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Generate Keywords</h5>
                    <p class="card-text pb-4 pt-1">Get Keyword Ideas from Google </p>
                    <a href="twits" class="btn btn-outline-primary">Access Keywords</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="card py-3 mb-4">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Google MyBusiness Ads</h5>
                    <p class="card-text pb-4 pt-1">Create Google MyBusiness Ads </p>
                    <a href="#" class="btn btn-outline-primary">Access Platform</a>
                  </div>
                </div>
              </div>
            </div>

            
           
</div>

        </div>
<?php include("footer.php"); ?>
