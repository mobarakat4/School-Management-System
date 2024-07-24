@extends('layouts.admin')
@section('title','All Users')
@section('head')
@endsection
@section('content')
<div class="page-content">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">All Roles</h6>
    <p class="text-muted mb-3"> <a href="{{route('admin.admin_manage.create')}}" > Add New Admin +</a></p>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Role</th>
            <th>Permissions</th>
            <th>created at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role )

            <tr>
              <td>{{$role->name}} </td>

              <td >

                @foreach ($role->permissions as $permission )
                    {{"( ". $permission->name ." )" }}
                @endforeach

              </td>
              <td>{{$role->created_at}}</td>
              <td>
                  <div class="dropdown">
                    <button type="button" class="action-icon"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('admin.role.show',['role' => $role->id])}}"
                        ><i class="bx bx-edit-alt me-2"></i> Show</a
                      >
                      <a class="dropdown-item" href="{{route('admin.role.edit',['role' => $role->id])}}"
                        ><i class="bx bx-edit-alt me-2"></i> Edit</a
                      >
                      <form action="{{route('admin.role.destroy',['role'=> $role->id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bx bx-trash me-2"></i> Delete
                        </button>
                      </form>
                    </div>
                  </div>
              </td>
            </tr>
            @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
        </div>
    </div>

</div>
@endsection

@section('js')

	<!-- Plugin js for this page -->
  <script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    @include('components.script.toaster')
	<!-- Custom js for this page -->
	<!-- End custom js for this page -->
@endsection
