@extends('layouts.layout')
@section('title', 'Target Form')
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
        @include('common.message')
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        @if(!empty($single_data))
          {!! Form::open(array('route' =>['targets.update', $single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $info ="Update";?>
        @else
        {!! Form::open(array('route' =>['targets.store'],'method'=>'POST','files'=>true)) !!}
          <?php $info ="Add";?>
        @endif
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{$info}} Set target for all.</div>
          </div>
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('month') is-invalid @enderror" data-live-search="true" name="month" required="">
                    <option value="">Select</option>
                    @foreach($months as $month)
                    <option value="{{$month}}" {{((!empty($single_data) && $single_data->month == $month) || ($month == date('F')))?'selected':''}}>{{$month}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Month<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('year') is-invalid @enderror" data-live-search="true" name="year" required="">
                    <option value="">Select</option>
                    @foreach($years as $year)
                    <option value="{{$year}}" {{((!empty($single_data) && $single_data->year == $year) || ($year == date('Y')))?'selected':''}}>{{$year}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Year<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
                <!-- Field wrapper start -->
                <div class="field-wrapper">
                  <input type="number" name="target" class="form-control @error('target') is-invalid @enderror">
                  <div class="field-placeholder">Target<span class="text-danger">*</span></div>
                </div>
                <!-- Field wrapper end -->
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">{{$info}}</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>

    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection 