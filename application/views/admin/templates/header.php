<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('public/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url('public/css/sb-admin-2.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('public/vendor/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
	
	<?php if(in_array($this->uri->segment(2),array('add_ad','edit_ad','edit_admin','profile','add_product','edit_product'))){ ?>
	<link href="<?=base_url('public/vendor/select2/select2.min.css')?>" rel="stylesheet">
	<?php } ?>
	
	<?php if(in_array($this->uri->segment(2),array('add_color','edit_color'))){ ?>
	<link href="<?=base_url('public/css/bootstrap-colorpicker.css')?>" rel="stylesheet">
	<?php } ?>

</head>
<?php if($this->session->user_type=='superadmin'){$vars=array('max_cat'=>'-1','max_pro'=>'-1','max_ser'=>'-1');}else{$vars=array('max_cat'=>get_limit('category'),'max_pro'=>get_limit('products'),'max_ser'=>get_limit('services'));}?>
<script> var base_url="<?=base_url()?>";var vars=[{"max_cat":"<?=get_limit('category')?>","max_pro":"<?=get_limit('products')?>","max_ser":"<?=get_limit('services')?>"}];</script>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">