<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="shortcut icon" href="/images/favicon.png">

      <title>Frontline</title>
      
      <!-- Bootstrap core CSS -->
      <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'> -->
      <link rel="stylesheet" href="/js/bootstrap/dist/css/bootstrap.css" />
      <link rel="stylesheet" href="/fonts/font-awesome-4/css/font-awesome.min.css" />

      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <![endif]-->
      
      <link rel="stylesheet" type="text/css" href="/js/jquery.gritter/css/jquery.gritter.css" />

      <link rel="stylesheet" type="text/css" href="/js/jquery.nanoscroller/nanoscroller.css" />
      <link rel="stylesheet" type="text/css" href="/js/jquery.easypiechart/jquery.easy-pie-chart.css" />
        <link rel="stylesheet" type="text/css" href="/js/bootstrap.switch/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />

        <link rel="stylesheet" type="text/css" href="/js/bootstrap.jasny/css/jasny-bootstrap.min.css" />

        <link rel="stylesheet" type="text/css" href="/js/jquery.select2/select2.css" />
        <link rel="stylesheet" type="text/css" href="/js/bootstrap.slider/css/slider.css" />
        <link rel="stylesheet" type="text/css" href="/js/intro.js/introjs.css" />
      <link rel="stylesheet" type="text/css" href="/js/jquery.vectormaps/jquery-jvectormap-1.2.2.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="/js/jquery.magnific-popup/dist/magnific-popup.css" />
      <link rel="stylesheet" type="text/css" href="/js/jquery.niftymodals/css/component.css" />
      <link rel="stylesheet" type="text/css" href="/js/bootstrap.wysihtml5/src/bootstrap-wysihtml5.css"></link>
      <link rel="stylesheet" type="text/css" href="/js/bootstrap.summernote/dist/summernote.css" />

      <link rel="stylesheet" href="/js/fuelux/css/fuelux.css">
      <link rel="stylesheet" href="/js/fuelux/css/fuelux-responsive.min.css">

      <link rel='stylesheet' type='text/css' href='/js/jquery.fullcalendar/fullcalendar/fullcalendar.css' />
      <link rel='stylesheet' type='text/css' href='/js/jquery.fullcalendar/fullcalendar/fullcalendar.print.css'  media='print' />

      <link rel="stylesheet" type="text/css" href="/js/jquery.magnific-popup/dist/magnific-popup.css" />

      <!-- Custom styles for this template -->
      <link rel="stylesheet" href="/css/style.css" />
      <link rel="stylesheet" href="/css/pygments.css" />
      <link rel="stylesheet" href="/js/jquery.icheck/skins/square/blue.css" />

      <link rel="stylesheet" href="/css/mystyle.css" />
    </head>
<body>

@include('layout.header')

@include('layout.sidebar')

@yield('container')   

@include('layout.modal')

@include('layout.footer')