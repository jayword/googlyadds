<?php include("headermain.php"); ?>
<script type="text/javascript">
  function justGoBack(){
    window.location = document.referrer;
  }
</script>
  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

<section style="display: none;">

<?php 
  
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

<?php 

//Create Customer
  if(isset($_POST["creato"])){
    
    $cusname = $_POST["codi"];
    $cuscli = $_POST["clitidi"];

    if(empty($cusname) || $cusname == NULL){
      echo "<script>alert('No Potential Customer Name has been provided. Please try again.')</script>";
      echo "<script>window.location='createcustomer'</script>";
    }else{

      $keyArr = array(
      "customerClient" => array(
          "descriptiveName" => "{$cusname}",
          "currencyCode" => "USD",
          "timeZone" => "Africa/Accra"
          )
      );
  
      $datae = json_encode($keyArr);
      
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://googleads.googleapis.com/v7/customers/6881908411:createCustomerClient",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_FOLLOWLOCATION => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"{$datae}",
      CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "developer-token: BXQVzyDFqVvqHc6-isOvmA",
          "login-customer-id: 6881908411",
        "Authorization: Bearer {$myarrtok}"
        ),
      ));
      $response = curl_exec($curl);
      
      curl_close($curl);
      
      $resp = json_decode($response, true);
      $resname = $resp["resourceName"];
      $resplode = explode("/", $resname);
      $resnumb = $resplode[1];
      $updi = "UPDATE googleclients SET customer_id = '".$resnumb."', customer_res = '".$resname."' WHERE clientid = '".$cuscli."' ";
      $supdi = mysqli_query($conn, $updi);
      if($supdi){
        echo "<script>alert('New Ad Client created successfully!')</script>";
      }
    }
    
}

?>

</section>
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
              <a href="admin_dashboard">
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
                    <a class="sidenav-item-link" href="admin_dashboard">
                      <i class="fa fa-dashboard"></i>
                      <span class="nav-text">Dashboard</span> <!--i class="fa fa-chevron-down"> </i-->
                    </a>
                  </li>
                  <li  class="has-sub active" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#ui-elements"
                      aria-expanded="false" aria-controls="ui-elements">
                      <i class="mdi mdi-folder-multiple-outline"></i>
                      <span class="nav-text" style="color: #4c84ff;">Advertize</span> <b class="caret"></b>
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
                              
                              <li>
                                
                                <a href="ads"><i class="fa fa-list"></i>&nbsp;&nbsp; All Ad Platforms</a>
                              </li>
                              
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

          </div>
        </aside>

      

      <div class="page-wrapper">
        <?php include("header.php"); ?>
        <div class="content-wrapper">
          <div class="content">
            <div class="row">
              <div class="col-xs-12">
                <nav aria-label="breadcrumb">
                  <a onclick="justGoBack(); return false;" class="btn btn-lg btn-success pull-left" style="color: #ffffff;"><i class="fa fa-arrow-left"></i> Back</a>
                  <ol class="breadcrumb breadcrumb-inverse">
                    <li class="breadcrumb-item">
                      <a href="#">Advertize</a>
                    </li>
                    <li class="breadcrumb-item">
                      <a href="#">Ad Campaigns</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Google</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Ad Customer</li>
                  </ol>
                </nav>
              </div>
            </div>						 
            <!-- Top Statistics -->
            
            <div class="row">
              
              <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                  <h2>Create New Ad Customer</h2>
                </div>
                <div class="card-body">
                  <form method="post" class="form-inline" action="createcustomer">
                    <div class="input-group mb-2 mr-sm-2">
                      <input type="text" name="codi" id="cod" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Customer Name" readonly />
                      <input type="hidden" name="clitidi" id="cliti" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Customer Name" readonly />
                    </div>
                    <button type="submit" name="creato" class="btn btn-primary mb-2">Create Customer</button>
                  </form>           
                </div>
              </div>
                  
              <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                  <h2>Refresh Expired Token</h2>
                </div>
                <div class="card-body">
                  <form method="post" class="form-inline" action="createcustomer">
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

            <div class="row">
              <div class="col-12">
                <div class="card card-table-border-none" id="recent-orders">
                  <div class="card-header justify-content-between">
                    <h2>Potential Customers</h2>
                    <!--div class="date-range-report ">
                      <span></span>
                    </div-->
                  </div>
                  <div class="card-body pt-0 pb-5">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Client Id</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Company</th>
                          <th>Ad Name</th>
                          <th><button id="butu" onclick="getCusto();" class="btn btn-primary">Selector</button></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $cuntoa = 0;
                          $sqo = mysqli_query($conn,"SELECT * FROM googleclients WHERE customer_id IS NULL OR customer_id = ' ' ");
                          while($rig = mysqli_fetch_assoc($sqo)){
                          $cuntoa++;

                          $clitid = $rig["clientid"];
                          $finame = $rig["firstname"];
                          $liname = $rig["lastname"];
                          $usern =  $rig["username"];
                          $comp = $rig["company"];
                          $adcustoname = $comp.$usern;
                        ?>
                        <tr>
                          <td><?php echo $cuntoa; ?></td>
                          <td><?php echo $clitid; ?></td>
                          <td><?php echo $finame; ?></td>
                          <td><?php echo $liname; ?></td>
                          <td><?php echo $comp; ?></td>
                          <td><?php echo $adcustoname; ?></td>
                          <td>
                            <input type="text" id="custon" value="<?php echo $adcustoname; ?>" readonly />
                            <input type="hidden" id="custoclit" value="<?php echo $clitid; ?>" readonly />
                          </td>
                        </tr>
                        <?php } ?><!--input type="text" id="custona" value="Jamie" readonly /-->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include("footer.php"); ?>
<script>
  function getCusto(){
    var getval = document.getElementById("custon").value;
    var getvalu = document.getElementById("custoclit").value;
    document.getElementById("cod").value = getval;
    document.getElementById("cliti").value = getvalu;
  }

  $(".table").DataTable();

</script>