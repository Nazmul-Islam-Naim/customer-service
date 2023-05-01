@extends('layouts.layout')
@section('title', 'Follow Up Form')
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
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Client Information</div>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img src="{{asset('storage/'.($customer->avatar??''))}}" width="150px" height="150px" alt="">
              <p>{{$customer->name}}</p>
              <p>{{$customer->businessCategory->name}}</p>
            </div><hr>
            <div>
              <p><i class="icon-phone me-2"></i>{{$customer->mobile}}</p>
              <p><i class="icon-email me-2"></i>{{$customer->email}}</p>
              <p><i class="icon-location me-2"></i>{{$customer->district->name}}</p>
              <p><i class="icon-globe me-2"></i>{{$customer->area->name}}</p>
              <p><i class="icon-address me-2"></i>{{$customer->address}}</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Follow up form</div>
          </div>
          <div class="card-body">
            {!! Form::open(array('route' =>['follow-ups-store'],'method'=>'POST','files'=>true)) !!}
              
              <!-- Row start -->
              <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="question1title">How is business going?<span class="text-danger">*</span></label><br>
                    <label class="form-check-label" for="question1good">
                      <input class="form-check-input" type="radio" name="question1" id="question1good" value="Good">
                      Good
                    </label><br>
                    <label class="form-check-label" for="question1better">
                      <input class="form-check-input" type="radio" name="question1" id="question1better" value="Better">
                      Better
                    </label><br>
                    <label class="form-check-label" for="question1best">
                      <input class="form-check-input" type="radio" name="question1" id="question1best" value="Best">
                      Best
                    </label><br>
                    <label class="form-check-label" for="question1bad">
                      <input class="form-check-input" type="radio" name="question1" id="question1bad" value="Bad">
                      Bad
                    </label><br>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="question2title">How is our product doing?<span class="text-danger">*</span></label><br>
                    <label class="form-check-label" for="question2good">
                      <input class="form-check-input" type="radio" name="question2" id="question2good" value="Good">
                      Good
                    </label><br>
                     <label class="form-check-label" for="question2better">
                      <input class="form-check-input" type="radio" name="question2" id="question2better" value="Better">
                      Better
                    </label><br>
                     <label class="form-check-label" for="question2best">
                      <input class="form-check-input" type="radio" name="question2" id="question2best" value="Best">
                      Best
                    </label><br>
                     <label class="form-check-label" for="question2bad">
                      <input class="form-check-input" type="radio" name="question2" id="question2bad" value="Bad">
                      Bad
                    </label><br>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="question3title">What is the customer's comment about the quality?<span class="text-danger">*</span></label><br>
                    <label class="form-check-label" for="question3good">
                      <input class="form-check-input" type="radio" name="question3" id="question3good" value="Good">
                      Good
                    </label><br>
                    <label class="form-check-label" for="question3better">
                      <input class="form-check-input" type="radio" name="question3" id="question3better" value="Better">
                      Better
                    </label><br>
                    <label class="form-check-label" for="question3best">
                      <input class="form-check-input" type="radio" name="question3" id="question3best" value="Best">
                      Best
                    </label><br>
                    <label class="form-check-label" for="question3bed">
                      <input class="form-check-input" type="radio" name="question3" id="question3bed" value="Bad">
                      Bad
                    </label><br>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="question4title">Client Priority <span class="text-danger">*</span></label><br>
                    <label class="form-check-label" for="question4low">
                      <input class="form-check-input" type="radio" name="question4" id="question4low" value="Low">
                      Low
                    </label><br>
                    <label class="form-check-label" for="question4medium">
                      <input class="form-check-input" type="radio" name="question4" id="question4medium" value="Medium">
                      Medium
                    </label><br>
                    <label class="form-check-label" for="question4high">
                      <input class="form-check-input" type="radio" name="question4" id="question4high" value="High">
                      High
                    </label><br>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="question5">How many products do you sell per month?</label><br>
                    <input type="number" name="question5" class="form-control @error('question5')@enderror" value="{{old('question5')}}">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <label for="comment">Client Comment</label><br>
                    <textarea name="comment" id="comment" class="form-control @error('comment')@enderror" style="height: 40px;">{{old('comment')}}</textarea>
                </div>
              </div>
              <!-- Row end -->
          </div>
          <div class="card-footer text-end">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection 