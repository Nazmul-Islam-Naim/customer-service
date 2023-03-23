@extends('layouts.layout')
@section('title', 'Set Target')
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
      
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">User List</div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <!--<table id="dataTable" class="table v-middle">-->
              <table id="example" class="table custom-table">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Area</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->
  </div>
  <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->

<div class="modal fade" id="ajaxModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="modelHeading"></h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="productForm" name="productForm" class="form-horizontal">
                <input type="hidden" name="product_id" id="product_id">

                  <!-- Field wrapper start -->
                  <div class="field-wrapper">
                    <div class="input-group">
                      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{(!empty($single_data->name))?$single_data->name:''}}" required="" autocomplete="off">
                    </div>
                    <div class="field-placeholder">Name<span class="text-danger">*</span></div>
                  </div>
                  <!-- Field wrapper end -->

                  <!-- Field wrapper start -->
                  <div class="field-wrapper">
                    <select class="business_cat_id select-single select2 js-state @error('business_cat_id') is-invalid @enderror" data-live-search="true" name="business_cat_id" id="business_cat_id"  required="">
                      
                    </select>
                    <div class="field-placeholder">Category<span class="text-danger">*</span></div>
                  </div>
                  <!-- Field wrapper end -->
      
                  <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                  </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{!!Html::script('custom/yajraTableJs/jquery.js')!!}
<script>
	$(document).ready(function() {
		'use strict';
      var table = $('#example').DataTable({
			serverSide: true,
			processing: true,
      deferRender : true,
			ajax: "{{route('targets.index')}}",
      "lengthMenu": [[ 50, 150, 250, -1 ],[ '100', '150', '250', 'All' ]],
      dom: 'Blfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'print',
                title:"",
                messageTop: function () {
                  // var top = '<center><p class ="text-center"><img src="{{asset("upload/logo")}}/header_pppo.jpg" width="100%"/></p></center>';
                //   top += '<center><h3>PPPO</h3></center>';
                  
                  return top;
                },
                customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
 
                $(win.document.body).find('table').css('font-size', 'inherit');
 
                $(win.document.body).find('table thead th').css('border','1px solid #ddd');  
                $(win.document.body).find('table tbody td').css('border','1px solid #ddd');  
                $(win.document.body).css("height", "auto").css("min-height", "0");
                },
                exportOptions: {
                    columns: [ 0, 1, 2]
                },
                messageBottom: null
            }
        ],
			aaSorting: [[0, "asc"]],

			columns: [
        {
          data: 'DT_RowIndex',
        },
				{
          data: 'name',
        },
				{
          data: 'phone',
        },
				{
          data: 'division.name',
        },
				{
          data: 'district.name',
        },
				{
          data: 'areas',
          render: function(data, type, row){
            var areas = '';
            $.each(data, function (key, value) { 
               areas = value.name + ', ';
            });
            return areas;
          }
        },
        {
          data: 'action',
        },
			]
    });

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    //create modal
    
    $('#createNewProduct').click(function () {
      
        $.ajax({
          method: "GET",
          url: "{{route('ajax-business-category')}}",
          dataType: "json",

          success:function(data) {
              $('.business_cat_id').empty();
              $('.business_cat_id').focus;
              $('.business_cat_id').append('<option value="">Select</option>');
              $.each(data, function(key, value){
                $('select[name="business_cat_id"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
              });
          }
        });
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });

    // update or create

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
      
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('products.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
       
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
           
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    //edit modal data

    $('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      var selected = '';
      $.get("{{ route('products.index') }}" +'/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#product_id').val(data.id);
          $('#name').val(data.name);
          var business_cat_id = data.business_cat_id;
          $.ajax({
          method: "GET",
          url: "{{route('ajax-business-category')}}",
          dataType: "json",

          success:function(data) {
              $('.business_cat_id').empty();
              $('.business_cat_id').focus;
              $('.business_cat_id').append('<option value="">Select</option>');
              $.each(data, function(key, value){
                if (value.id == business_cat_id) {
                  selected = 'selected';
                }else{
                  selected = '';
                }
                $('select[name="business_cat_id"]').append('<option '+selected+' value="'+ value.id +'">' + value.name+ '</option>');
              });
          }
        });
      })
    });



     //-------- Delete single data with Ajax --------------//
     $("#example").on("click", ".button-delete", function(e) {
			  e.preventDefault();

        var confirm = window.confirm('Are you sure want to delete data?');
        if (confirm != true) {
          return false;
        }
        var id = $(this).data('id');
        var link = '{{route("products.destroy",":id")}}';
        var link = link.replace(':id', id);
        var token = '{{csrf_token()}}';
        $.ajax({
          url: link,
          type: 'POST',
          data: {
            '_method': 'DELETE',
            '_token': token
          },
          success: function(data) {
            table.ajax.reload();
          },
          error: function (data) {
              console.log('Error:', data);
          }

        });
    });
});
</script>
@endsection 