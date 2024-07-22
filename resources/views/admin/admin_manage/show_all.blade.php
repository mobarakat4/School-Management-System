@extends('layouts.admin')
@section('title','All Users')
@section('head')
@endsection
@section('content')
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Data Table</h6>
    <p class="text-muted mb-3"> <a href="{{-- route('admin.admin_manage.add')--}}" > Add New Admin +</a></p>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>phone</th>
            <th>Address</th>
            <th>create date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin )

            <tr>
              <td>{{$admin->name}} </td>
              <td>{{$admin->email}} </td>
              <td>{{$admin->phone}}</td>
              <td>{{(!empty($admin->address->address))?$admin->address->address:"no address"}}</td>
              <td>{{$admin->created_at}}</td>
              <td>
                  <div class="dropdown">
                    <button type="button" class="action-icon"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('admin.admin_manage',['id' => $admin->id])}}"
                        ><i class="bx bx-edit-alt me-2"></i> Show</a
                      >
                      <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-2"></i> Edit</a
                      >
                      <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-2"></i> Delete</a
                      >
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

	<!-- Custom js for this page -->
	<!-- End custom js for this page -->
@endsection
