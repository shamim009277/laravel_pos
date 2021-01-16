<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                @php $dashboard = 'admin/home'; @endphp
                <li>
                    <a href="{{route('home')}}" class="{{request()->is($dashboard)? 'active' : ''}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="{{route('pos')}}" class=""><i class="lnr lnr-home"></i> <span>POS</span></a>
                </li>

                @php $employee = 'admin/employee*'; @endphp
                <li>
                    <a href="{{URL::to('admin/employee')}}" class="{{request()->is($employee)?'active':''}}"><i class="lnr lnr-user"></i> <span>Employee</span></a>
                </li>
                @php $customer = 'admin/customer*'; @endphp
                <li>
                    <a href="{{URL::to('admin/customer')}}" class="{{request()->is($customer)?'active':''}}"><i class="lnr lnr-user"></i> <span>Customer</span></a>
                </li>
                @php $supplier = 'admin/supplier*'; @endphp
                <li>
                    <a href="{{URL::to('admin/supplier')}}" class="{{request()->is($supplier)?'active':''}}"><i class="lnr lnr-user"></i> <span>Supplier</span></a>
                </li>

                <li>
                    <a href="#Pages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Attendence</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="Pages" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{route('attendence.take')}}" class="">Take Attendence</a></li>
                            <li><a href="{{route('attendence.all')}}" class="">All Attendence</a></li>
                            <li><a href="{{route('month.attendence')}}" class="">Monthly Attendence</a></li>
                        </ul>
                    </div>
                </li>
                
                <li>
                    <a href="#salary" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Salary(EMP)</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="salary" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{URL::to('admin/advance_salary')}}" class="">Advanced Salary</a></li>
                            <li><a href="page-login.html" class="">Salary</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#expense" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Expense</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="expense" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{route('add.expense')}}" class="">Add Expense</a></li>
                            <li><a href="{{route('expense.today')}}" class="">Today</a></li>
                            <li><a href="{{route('expense.monthly')}}" class="">Monthly</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sales" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Sales Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="sales" class="collapse ">
                        <ul class="nav">
                            <li><a href="" class="">Add Expense</a></li>
                            <li><a href="" class="">Today</a></li>
                            <li><a href="" class="">Monthly</a></li>
                        </ul>
                    </div>
                </li>

                @php $category = 'admin/category*'; @endphp
                <li>
                    <a href="{{URL::to('admin/category')}}" class="{{request()->is($category)?'active':''}}"><i class="lnr lnr-user"></i> <span>Category</span></a>
                </li>

                @php $products = 'admin/products*'; @endphp
                <li>
                    <a href="{{URL::to('admin/products')}}" class="{{request()->is($products)?'active':''}}"><i class="lnr lnr-user"></i> <span>Products</span></a>
                </li>

                @php $settings = 'admin/settings*'; @endphp
                <li>
                    <a href="{{URL::to('admin/settings')}}" class="{{request()->is($settings)?'active':''}}"><i class="lnr lnr-cog"></i> <span>Settings</span></a>
                </li>

                
                
            </ul>
        </nav>
    </div>
</div>