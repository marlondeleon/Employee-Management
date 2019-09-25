<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="{{ url('/employees') }}">
          <i class="fa fa-th"></i> <span>Employees</span>
        </a>
      </li>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>APIs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('/api/employees') }}" target="_blank"><i class="fa fa-circle-o"></i> api/employees</a></li>
            <li><a href="{{ url('/api/employees/1') }}" target="_blank"><i class="fa fa-circle-o"></i> api/employees/{id}</a></li>
          </ul>
        </li>
    </ul>
  </section>
</aside>