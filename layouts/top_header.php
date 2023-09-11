<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
  <?php if(!isset($title)){ ?>
    Panabo HRMIS
  <?php } else { ?>
    <?php echo($title); ?>
  <?php } ?>
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="AdminLTE/dist/css/skins/_all-skins.min.css">
  <link rel="icon" type="image/png" sizes="16x16" href="resources/hr_logo.png">
  <style>
  .rheader {
      padding: 10px 10px 10px 10px !important;
  }
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav fixed">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top" style="box-shadow: 0 14px 28px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.22)!important;">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>HRMIS</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <?php require("topnav.php"); ?>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="AdminLTE/dist/img/user-avatar.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo($_SESSION["hrmis_system"]["uname"]); ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                <img src="AdminLTE/dist/img/user-avatar.png" class="user-image" alt="User Image">
                  <p>
                  <?php echo($_SESSION["hrmis_system"]["uname"]); ?>
                    <small></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                  <a href="logout" class="btn btn-primary btn-flat btn-block">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
     
    </nav>
  </header>
  <script src="AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<audio id="chatAudio"><source src="facebook_pop.mp3" type="audio/mpeg"></audio>
<script src="AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>


  
