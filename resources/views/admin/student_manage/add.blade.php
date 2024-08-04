@extends('layouts.admin')
@section('title')
@lang('messages.add') @lang('messages.student')
@endsection
@section('content')

<div class="page-content perfect-scrollbar-example">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('messages.main')</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.student_manage.index')}}">@lang('messages.students')</a></li>
          <li class="breadcrumb-item active" aria-current="page">@lang('messages.add')</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title ">@lang('messages.add') @lang('messages.student')</h2>
                    <form action="{{route('admin.student_manage.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-4">
                            <label for="exampleInputText1" class="form-label">@lang('messages.name')</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="name" value="{{old('name')}}" placeholder="@lang('messages.enter') @lang('messages.name')">
                            @error('name')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">@lang('messages.username')</label>
                            <input type="text" required class="form-control" id="exampleInputText1" name="username" value="{{old('username')}}" placeholder="@lang('messages.enter') @lang('messages.username')">
                            @error('username')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail3" class="form-label">@lang('messages.email') </label>
                            <input type="email" required class="form-control" id="exampleInputEmail3" name='email' value="{{old('email')}}" placeholder="@lang('messages.enter') @lang('messages.email')">
                            @error('email')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">@lang('messages.phone')</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="phone" value="{{old('phone')}}" placeholder="@lang('messages.enter') @lang('messages.phone')">
                            @error('phone')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">@lang('messages.adderss')</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="address" value="{{old('address')}}" placeholder="@lang('messages.enter') @lang('messages.adderss')">
                            @error('address')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">@lang('messages.city')</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="city" value="{{old('city')}}" placeholder="@lang('messages.enter') @lang('messages.city')">
                            @error('city')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword3" class="form-label">@lang('messages.Password')</label>
                            <input type="password" class="form-control" id="exampleInputPassword3" name="password"  placeholder="@lang('messages.enter') @lang('messages.Password')">
                            @error('password')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">@lang('messages.select') @lang('messages.status') </label>
                            <select class="form-select" name="status" id="exampleFormControlSelect1">
                                @if(old('status')=='inactive')
                                    <option value="active">@lang('messages.active')</option>
                                    <option value="inactive" selected>@lang('messages.inactive')</option>
                                @else
                                    <option value="active" selected>@lang('messages.active')</option>
                                    <option value="inactive">@lang('messages.inactive')</option>
                                @endif
                            </select>
                            @error('status')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">@lang('messages.image')</label>
                            <input type="file" class="form-control" name="photo" id="uimage" autocomplete="off" placeholder="@lang('image')">
                            @error('photo')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="mb-3 mx-4">
                            <img width="100" height="100" class=" rounded-circle" id="simage"
                            src="{{ url("images/admins/no_image.jpg")}}"
                            alt="profile image">
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
@endsection
