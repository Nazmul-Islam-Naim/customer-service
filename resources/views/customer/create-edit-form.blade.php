@extends('layouts.layout')
@section('title', 'Add/Edit Customer')
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
    </div>
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          @if(!empty($single_data))
          {!! Form::open(array('route' =>['customers.update',$single_data->id],'method'=>'PUT','files'=>true)) !!}
          <?php $btn='Update';?>
          @else
          {!! Form::open(array('route' =>['customers.store'],'method'=>'POST','files'=>true)) !!}
          <?php $btn='Add';?>
          @endif
          <div class="card-header">
            <div class="card-title">{{$btn}} User</div>
            <a href="{{route('customers.index')}}" class="btn btn-sm btn-warning pull-right"><i class="icon-corner-down-right"></i> <b>Back</b></a>
          </div>
          
          <div class="card-body">
            <!-- Row start -->
            <div class="row gutters">
              <!------------------- name --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <input type="text" name="name" value="{{!empty($single_data->name)?$single_data->name:''}}" autocomplete="off">
                  <div class="field-placeholder">Name <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- phone --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <input type="text" name="mobile" value="{{!empty($single_data->mobile)?$single_data->mobile:''}}" autocomplete="off">
                  <div class="field-placeholder">Mobile <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- email --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <input type="text" name="email" value="{{!empty($single_data->email)?$single_data->email:''}}" autocomplete="off">
                  <div class="field-placeholder">Email</div>
                </div>
              </div>
              <!------------------- address --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <input type="text" name="address" value="{{!empty($single_data)?$single_data->address:''}}" autocomplete="off">
                  <div class="field-placeholder">Address</div>
                </div>
              </div>
              <!------------------- area --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <select class="select-single js-states select2 @error('area_id') is-invalid @enderror" name="area_id" id="area_id" required="">
                      <option value="">Select</option>
                      @foreach($areas as $area)
                      <option value="{{$area->id}}" {{(!empty($single_data) && $single_data->area_id == $area->id)?'selected':''}}>{{$area->name}}</option>
                      @endforeach
                  </select>
                  <div class="field-placeholder">Area<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- business category --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('business_cat_id') is-invalid @enderror" data-live-search="true" name="business_cat_id" id="business_cat_id" required="">
                    <option value="">Select</option>
                    @foreach($bCategories as $bCategory)
                    <option value="{{$bCategory->id}}" {{(!empty($single_data) && $single_data->business_cat_id == $bCategory->id)?'selected':''}}>{{$bCategory->name}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Business Categories<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- product --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <select class="select-multiple js-states select2 @error('product_id') is-invalid @enderror" multiple="multiple" name="product_id[]" id="product_id" required="">
                    @if (!empty($single_data))
                      <option value="">Select</option>
                      @foreach($products as $product)
                      <option value="{{$product->id}}" {{(!empty($single_data) && in_array($product->id, $allproducts))?'selected':''}}>{{$product->name}}</option>
                      @endforeach
                    @endif
                  </select>
                  <div class="field-placeholder">Products<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- priority --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <select class="select-single select2 js-state @error('priority_id') is-invalid @enderror" data-live-search="true" name="priority_id" id="priority_id" required="">
                    @foreach($priorites as $key => $priority)
                    <option value="{{$priority}}" {{(!empty($single_data) && $single_data->priority_id == $priority)?'selected':''}}>{{$key}}</option>
                    @endforeach
                  </select>
                  <div class="field-placeholder">Priority<span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- date --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <input type="date" name="date" value="{{!empty($single_data)? $single_data->date : date('Y-m-d')}}" autocomplete="off">
                  <div class="field-placeholder">Date <span class="text-danger">*</span></div>
                </div>
              </div>
              <!------------------- avatar --------------------------->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="field-wrapper">
                  <input type="file" name="avatar" value="">
                  <div class="field-placeholder">Avatar</div>
                </div>
              </div>
              <!------------------- comment --------------------------->
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="field-wrapper">
                  <textarea name="comment" style="height: 40px">{{!empty($single_data->comment)?$single_data->comment:''}}</textarea>
                  <div class="field-placeholder">Comment</div>
                </div>
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" type="submit">{{$btn}}</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
{!! Html::script('custom/js/jquery.min.js') !!}
<script>
  $(document).ready(function () {

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $('#business_cat_id').change(function (e) { 
      e.preventDefault();
      var businessCategoryId = $(this).val();
      $.ajax({
        type: "POST",
        url: "{{route('get-products-by-business-cateygory-id')}}",
        data: {"businessCategoryId":businessCategoryId},
        dataType: "JSON",
        success: function (response) {
          $('#product_id').empty();
          $('#product_id').append('<option value="">Select</option>');
          $.each(response, function (key, value) { 
            $('#product_id').append('<option  value="'+ value.id +'">' + value.name+ '</option>');
          });
        }
      });
      
    });

  });
</script>
@endsection