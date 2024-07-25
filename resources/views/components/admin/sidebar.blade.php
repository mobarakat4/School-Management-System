<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand " style="font-size: large !important">
        <p style="display: inline">@lang('messages.school')</p>
        <span > @lang('messages.management') </span>
        </a>
        <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category ar-fontlarge ar-dir">@lang('messages.main')</li>
        <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link ar-dir">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title ar-fontlarge"> {{__('messages.dashboard')}} </span>
            </a>
        </li>
        <li class="nav-item nav-category ar-fontlarge ar-dir">{{__('messages.user management')}} </li>
        <li class="nav-item ">
            <a class="nav-link ar-dir" data-bs-toggle="collapse" href="#admins" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title ar-fontlarge ">{{__('messages.admins')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="admins">
                <ul class="nav sub-menu">
                    <li class="nav-item ">
                    <a href="{{route('admin.admin_manage.index')}}" class="nav-link ar-dir ar-fontlarge">{{__('messages.show')}} </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{route('admin.admin_manage.create')}}" class="nav-link ar-dir ar-fontlarge" > {{__('messages.add')}} </a>
                    </li>
                </ul>
                </div>
        </li>
        <li class="nav-item nav-category ar-dir ar-fontlarge"> {{__('messages.role management')}} </li>
        <li class="nav-item">
            <a class="nav-link ar-dir" data-bs-toggle="collapse" href="#roles" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title ar-fontlarge">{{__('messages.roles')}} </span>
            <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="  tcollapse" id="roles">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                    <a href="{{route('admin.role.index')}}" class="nav-link ar-dir ar-fontlarge">{{__('messages.show')}} </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{route('admin.role.create')}}" class="nav-link ar-dir ar-fontlarge"> {{__('messages.add')}} </a>
                    </li>
                </ul>
                </div>
        </li>




        </ul>
    </div>
    </nav>
