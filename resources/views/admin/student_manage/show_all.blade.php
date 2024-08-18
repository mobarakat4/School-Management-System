@extends('layouts.admin')
@section('title')
@lang('messages.all') @lang('messages.students')
@endsection
@section('head')
@endsection
@section('content')
<div class="page-content">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('messages.main')</a></li>
          <li class="breadcrumb-item active" aria-current="page">@lang('messages.students')</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">@lang('messages.all') @lang('messages.admins')</h6>
    <p class="text-muted mb-3"> <a href="{{route('admin.student_manage.create')}}" > @lang('messages.add') @lang('messages.student') +</a></p>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>@lang('messages.username')</th>
            <th>@lang('messages.email')</th>
            <th>@lang('messages.phone')</th>
            <th>@lang('messages.status')</th>
            <th>@lang('messages.created at')</th>
            <th>@lang('messages.action')</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($students as $student )

            <tr>
              <td>{{$student->username}} </td>
              <td>{{$student->email}} </td>
              <td>{{$student->phone}}</td>
              <td>
                @if($student->status == 'active')
                <span class="badge bg-success">@lang('messages.active')</span>
                @else
                <span class="badge bg-danger">@lang('messages.inactive')</span>
                @endif
              </td>
              <td>{{$student->created_at}}</td>
              <td>
                  <div class="dropdown">
                    <button type="button" class="action-icon"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('admin.student_manage.show',['student_manage' => $student->id])}}"
                        ><i class="bx bx-edit-alt me-2"></i> @lang('messages.show') </a
                      >
                      <a class="dropdown-item" href="{{route('admin.student_manage.edit',['student_manage' => $student->id])}}"
                        ><i class="bx bx-edit-alt me-2"></i> @lang('messages.update')</a
                      >
                      <form action="{{route('admin.student_manage.destroy',['student_manage'=> $student->id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bx bx-trash me-2"></i> @lang('messages.delete')
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
    @include('components.script.datatable')
    @include('components.script.toaster')
	<!-- Custom js for this page -->
	<!-- End custom js for this page -->
@endsection
