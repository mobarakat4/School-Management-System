@extends('layouts.admin')
@section('title','Add Admin')
@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Basic Elements</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Inputs</h6>
                    <form action="{{route('admin.admin_manage.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="name" value="" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="username" value="" placeholder="Enter username">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail3" class="form-label">Email </label>
                            <input type="email" class="form-control" id="exampleInputEmail3" name value="" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">phone</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="phone" value="" placeholder="Enter phone">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="address" value="" placeholder="Enter address">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText1" class="form-label">City</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="city" value="" placeholder="Enter city">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="exampleInputNumber1" class="form-label">Number Input</label>
                            <input type="number" class="form-control" id="exampleInputNumber1" value="6473786">
                        </div> --}}

                        <div class="mb-3">
                            <label for="exampleInputPassword3" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword3" name="password" placeholder="Enter Password">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputDisabled1" class="form-label">Role</label>
                            <input type="text" class="form-control" id="exampleInputDisabled1" disabled value="admin">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="exampleInputPlaceholder" class="form-label">Placeholder</label>
                            <input type="text" class="form-control" id="exampleInputPlaceholder" placeholder="Enter Your Name">
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label for="exampleInputReadonly" class="form-label">Readonly</label>
                            <input type="text" class="form-control" id="exampleInputReadonly" readonly value="Amiah Burton">
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Select Input</label>
                            <select class="form-select" id="exampleFormControlSelect1">
                                <option selected disabled>Select your age</option>
                                <option>12-18</option>
                                <option>18-22</option>
                                <option>22-30</option>
                                <option>30-60</option>
                                <option>Above 60</option>
                            </select>
                        </div> --}}
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Select Status</label>
                            <select class="form-select" name="status" id="exampleFormControlSelect1">

                                <option value="active">Active</option>
                                <option value="inactive">In Active</option>
                            </select>
                            @error('photo')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" name="photo" id="uimage" autocomplete="off" placeholder="Password">
                            @error('photo')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="mb-3 mx-4">
                            <img width="100" height="100" class=" rounded-circle" id="simage" src="{{!(empty($user->photo)) ? url("storage/images/admins/"."$user->photo") : url("images/admins/no_image.jpg")}}" alt="profile image">
                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
