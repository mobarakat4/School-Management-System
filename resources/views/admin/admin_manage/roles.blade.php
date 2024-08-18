@extends('layouts.admin')
@section('title')
@lang('messages.add') @lang('messages.roles')
@endsection
@section('head')

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/dropzone/dropzone.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/dropify/dist/dropify.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/pickr/themes/classic.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/flatpickr/flatpickr.min.css')}}">
@endsection
@section('content')

<div class="page-content perfect-scrollbar-example">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('messages.main')</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.admin_manage.index')}}">@lang('messages.admin management')</a></li>
          <li class="breadcrumb-item active" aria-current="page">@lang('messages.roles')</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title ">@lang('messages.role management') </h2>
                    <form action="{{route('admin.admin_manage.roles',['admin_manage'=>$user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-4">
                            <label for="exampleInputText1" class="form-label">@lang('messages.username')</label>
                            <input type="text" class="form-control" name="name" value="{{$user->username}} " disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('messages.roles')</label>
                            <select class="js-example-basic-multiple form-select" name = "roles[]" multiple="multiple" data-width="100%">
                                @foreach ($roles as $role )

                                    <option value="{{$role->id}}"
                                        @if(in_array($role->name , $userroles ))
                                            selected
                                        @endif
                                        >{{$role->name}}
                                    </option>
                                @endforeach


                            </select>
                        </div>



                        <button class="btn btn-primary" type="submit">@lang('messages.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
@section('js')
@include('components.script.toaster')
	<!-- Plugin js for this page -->
	<script src="{{asset('assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
	<script src="{{asset('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
	<script src="{{asset('assets/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
	<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
	<script src="{{asset('assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
	<script src="{{asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
	<script src="{{asset('assets/vendors/dropzone/dropzone.min.js')}}"></script>
	<script src="{{asset('assets/vendors/dropify/dist/dropify.min.js')}}"></script>
	<script src="{{asset('assets/vendors/pickr/pickr.min.js')}}"></script>
	<script src="{{asset('assets/vendors/moment/moment.min.js')}}"></script>
	<script src="{{asset('assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('assets/js/template.js')}}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<script src="{{asset('assets/js/form-validation.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap-maxlength.js')}}"></script>
	<script src="{{asset('assets/js/inputmask.js')}}"></script>
	<script src="{{asset('assets/js/select2.js')}}"></script>
	<script src="{{asset('assets/js/typeahead.js')}}"></script>
	<script src="{{asset('assets/js/tags-input.js')}}"></script>
	<script src="{{asset('assets/js/dropzone.js')}}"></script>
	<script src="{{asset('assets/js/dropify.js')}}"></script>
	<script src="{{asset('assets/js/pickr.js')}}"></script>
	<script src="{{asset('assets/js/flatpickr.js')}}"></script>
	<!-- End custom js for this page -->
@endsection
