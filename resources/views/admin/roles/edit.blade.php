@extends('layouts.admin')
@section('title','Add Admin')
@section('content')

<div class="page-content">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.role.index')}}">Roles</a></li>
          <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title ">Add Admin</h2>
                    <form action="{{route('admin.role.update',['role'=>$role->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3 mt-4">
                            <label for="exampleInputText1" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="name" value="{{$role->name}}" placeholder="Enter Name">
                            @error('name')
                                <div class="alert alert-danger"> {{$message}} </div>
                            @enderror
                        </div>
    <div class="mb-3">
        <label class="form-label">Permissions</label>
        <div>
            @foreach ($permissions as $permission )

            <div class="form-check form-check-inline">
              <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                {{$role->permissions->contains($permission->id) ? 'checked' : ''}}
              class="form-check-input" id="checkInline{{$permission->id}}">
              <label class="form-check-label" for="checkInline{{$permission->id}}">
                {{$permission->name}}
              </label>
            </div>
            @endforeach

        </div>
    </div>










                        <button class="btn btn-primary" type="submit">Submit</button>
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
