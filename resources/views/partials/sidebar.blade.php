<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::check())
            <img src="{{ asset(Auth::user()->getProfilePic())}}" class="img-circle" alt="User Image">
          @else 
            <img src="{{ asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          @if(Auth::check())
          <p>{{Auth::user()->getFirstname()}} {{Auth::user()->getLastName()}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          @endif
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{url('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
       {{--  <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Group Products</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Group Users</a></li>
          </ul>
        </li> --}}
        <li>
          <a href="#">
          <i class="fa fa-file-text-o"></i>
            <span>Memo</span>
          </a>
        </li>
        <li>
          <a href="{{url('orders')}}">
            <i class="fa fa-shopping-cart"></i>
            <span>Orders</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Calendar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>