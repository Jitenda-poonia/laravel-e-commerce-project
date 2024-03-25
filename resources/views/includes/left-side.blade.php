<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->getFirstMediaUrl('image') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }} <br>
                    <small>{{ lastlogintime() }}</small>
                </p>


            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">



            @can('user_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Manage User</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('user.create') }}"><i class="fa fa-user"></i><i
                                    class="fa fa-plus-square"></i>User</a></li>
                        <li><a href="{{ route('user.index') }}"><i class="fa fa-users"></i>user List</a></li>
                        <li><a href="{{ route('user.show', Auth::user()->id) }}"><i class="fa fa-user-md"></i><span>User
                                    Profile</span></a></li>

                    </ul>
                </li>
            @endcan
            @can('manage_permission')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-lock"></i>
                        <span>Manage permission</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('permission.create') }}"><i class="fa fa-unlock"></i>Add Permission</a></li>
                        <li><a href="{{ route('permission.index') }}"><i class="fa  fa-list"></i>Permission List</a></li>

                    </ul>
                </li>
            @endcan
            @can('manage_role')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Manage Role</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('role.create') }}"><i class="fa fa-plus-square"></i> Role</a></li>
                        <li><a href="{{ route('role.index') }}"><i class="fa  fa-list"></i>Role List</a></li>

                    </ul>
                </li>
            @endcan

            @can('slider_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-sliders"></i>
                        <span>Manage Slider</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('slider.create') }}"><i class="fa fa-plus-square"></i> Slider</a></li>
                        <li><a href="{{ route('slider.index') }}"><i class="fa  fa-list"></i>Slider List</a></li>

                    </ul>
                </li>
            @endcan

            @can('page_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-file-text-o"></i>
                        <span>Manage Page</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('page.create') }}"><i class="fa fa-plus-square"></i> Page</a></li>
                        <li><a href="{{ route('page.index') }}"><i class="fa  fa-list"></i>Page List</a></li>

                    </ul>
                </li>
            @endcan

            @can('block_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-circle-o"></i>
                        <span>Manage Block</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('block.create') }}"><i class="fa fa-plus-square"></i> Block</a></li>
                        <li><a href="{{ route('block.index') }}"><i class="fa  fa-list"></i>Block List</a></li>

                    </ul>
                </li>
            @endcan
            @can('product_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-yelp"></i>
                        <span>Manage Product</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('product.create') }}"><i class="fa fa-plus-square"></i> Product</a></li>
                        <li><a href="{{ route('product.index') }}"><i class="fa  fa-list"></i>Product List</a></li>

                    </ul>
                </li>
            @endcan
            @can('category_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-puzzle-piece"></i>
                        <span>Manage Category</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('category.create') }}"><i class="fa fa-plus-square"></i> Category</a></li>
                        <li><a href="{{ route('category.index') }}"><i class="fa  fa-list"></i>Category List</a></li>

                    </ul>
                </li>
            @endcan
            @can('attribute_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-tag"></i>
                        <span>Manage Attribute</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('attribute.create') }}"><i class="fa fa-plus-square"></i> Attribute</a>
                        </li>
                        <li><a href="{{ route('attribute.index') }}"><i class="fa  fa-list"></i>Attribute List</a></li>

                    </ul>
                </li>
            @endcan
            @can('coupon_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gift"></i>
                        <span>Manage Coupon</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('coupon.create') }}"><i class="fa fa-plus-square"></i> Coupon</a></li>
                        <li><a href="{{ route('coupon.index') }}"><i class="fa  fa-list"></i> Coupon List</a></li>
                    </ul>
                </li>
            @endcan

            @can('manage_orders')
                <li class="treeview">
                    <a href="{{ route('order.index') }}">
                        <i class="fa fa-shopping-cart"></i> <!-- Choose a suitable icon for orders -->
                        <span>Manage Order</span>
                    </a>
                </li>
            @endcan

            @can('manage_customer')
                <li class="treeview">
                    <a href="{{ route('customer.index') }}">
                        <i class="fa fa-users"></i> <!-- Choose a suitable icon for customers -->
                        <span>Manage Customer</span>
                    </a>
                </li>
            @endcan



            @can('enquiry')
                <li class="treeview">
                    <a href="{{ route('enquiry') }}">
                        <i class="fa fa-bell"></i>
                        <span>Enquiry</span>

                    </a>

                </li>
            @endcan
            {{-- <li>
                <a href="{{ asset('pages/calendar.html') }}">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="{{ asset('pages/mailbox/mailbox.html') }}">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="label pull-right bg-yellow">12</small>
                </a>
            </li> --}}


        </ul> 
    </section>
    <!-- /.sidebar -->
</aside>
