@extends('layouts.layout')
@section('title', 'User Performances')
@section('content')
<!-- Content Header (Page header) -->
<?php
  $baseUrl = URL::to('/');
?>
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div id="basic-column-graph-datalables" style="height: 450px"></div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!!Html::script('custom/js/jquery.min.js')!!}
{!!Html::script('custom/vendor/apex/apexcharts.min.js')!!}
{!!Html::script('custom/vendor/apex/examples/column/basic-column-graph-datalables.js')!!} 
@endsection 