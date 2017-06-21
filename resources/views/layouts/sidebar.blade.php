@section('sidebarmenu')
    @can('Administer')
        <li class="header">Quản Lý Hệ Thống Panel</li>
        <li class="">
            <a href="/trans-manager">
                <i class="fa fa-fw fa-cogs" aria-hidden="true"></i>
                <span>Tùy Chỉnh Permissions</span>
            </a>
        </li>
        <li class="">
            <a href="/trans-manager">
                <i class="fa fa-fw fa-cogs" aria-hidden="true"></i>
                <span>Tùy Chỉnh Roles</span>
            </a>
        </li>
    @endcan
    @can('notificationManager')
        <li class="header">Quản Lý Thông Báo</li>
        <li class="">
            <a href="/trans-manager">
                <i class="fa fa-fw fa-bullhorn "></i>
                <span>Danh Sách Khách Hàng</span>
            </a>
        </li>
    @endcan
    @can('buyinManager')
        <li class="header">Quản Lý Hạn Mức</li>
        <li class="">
            <a href="/trans-manager">
                <i class="fa fa-fw fa-diamond "></i>
                <span>Truy Cập Khách Hàng</span>
            </a>
        </li>
    @endcan
    @can('usersManager')
        <li class="header">Quản Lý Khách Hàng</li>
        <li class="">
            <a href="/trans-manager">
                <i class="fa fa-fw fa-user "></i>
                <span>Danh Sách Khách Hàng</span>
            </a>
        </li>
    @endcan
    @can('transManager')
        <li class="header">Quản Lý Giao Dịch Khách Hàng</li>
        <li class="">
            <a href="/trans-manager">
                <i class="fa fa-money "></i>
                <span>Giao dịch của khách hàng</span>
            </a>
        </li>
    @endcan
    @can('userInfo')
        <li class="header">ACCOUNT SETTINGS</li>
        <li class="">
            <a href="/profile">
                <i class="fa fa-fw fa-user "></i>
                <span>Thông Tin Tài Khoản</span>
            </a>
        </li>
        <li class="">
            <a href="/profile/{{ Auth::user()->id }}/edit">
                <i class="fa fa-fw fa-lock "></i>
                <span>Đổi Mật Khẩu</span>
            </a>
        </li>
    @endcan
    @can('viewTrans')
        <li class="header">Tra Cứu Giao Dịch</li>
        <li class="">
            <a href="/history">
                <i class="fa fa-fw fa-search "></i>
                <span>Lịch sử mua thẻ</span>
                <span class="pull-right-container">
                    <span class="label label-success pull-right">1</span>
                </span>
            </a>
        </li>
    @endcan
@endsection