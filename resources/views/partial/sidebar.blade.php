<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                @php $dashboard = 'admin/home'; @endphp
                <li>
                    <a href="{{route('home')}}" class="{{Request::is($dashboard)? 'active' : ''}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>
                @php $dashboard = 'admin/pos'; @endphp
                <li>
                    <a href="{{route('pos')}}" class="{{Request::is($dashboard)?'active':''}}"><i class="lnr lnr-code"></i> <span>POS</span></a>
                </li>

                @php $employee = 'admin/employee*'; @endphp
                <li>
                    <a href="{{URL::to('admin/employee')}}" class="{{Request::is($employee)?'active':''}}"><i class="lnr lnr-user"></i> <span>Employee</span></a>
                </li>
                @php $customer = 'admin/customer*'; @endphp
                <li>
                    <a href="{{URL::to('admin/customer')}}" class="{{Request::is($customer)?'active':''}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>Customer</span></a>
                </li>
                @php $supplier = 'admin/supplier*'; @endphp
                <li>
                    <a href="{{URL::to('admin/supplier')}}" class="{{Request::is($supplier)?'active':''}}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>Supplier</span></a>
                </li>
                @php 
                      $take_att = 'admin/attendence';
                      $all_att = 'admin/all_attendence';
                      $monthly_att = 'admin/monthly_attendence';   
                 @endphp
                <li>
                    <a href="#Pages" data-toggle="collapse" class="{{Request::is($take_att)||Request::is($all_att)||Request::is($monthly_att)?'active':'collapsed'}}" aria-expanded="{{Request::is($take_att)||Request::is($all_att)||Request::is($monthly_att)?'true':'false'}}"><i class="lnr lnr-chart-bars"></i> <span>Attendence</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="Pages" class="{{Request::is($take_att)||Request::is($all_att)||Request::is($monthly_att)?'collapse in':'collapse'}}" aria-expanded="{{Request::is($take_att)||Request::is($all_att)||Request::is($monthly_att)?'true':'false'}}">
                        <ul class="nav">
                            <li><a href="{{route('attendence.take')}}" class="{{Request::is($take_att)?'active':''}}">Take Attendence</a></li>
                            <li><a href="{{route('attendence.all')}}" class="{{Request::is($all_att)?'active':''}}">All Attendence</a></li>
                            <li><a href="{{route('month.attendence')}}" class="{{Request::is($monthly_att)?'active':''}}">Monthly Attendence</a></li>
                        </ul>
                    </div>
                </li>
                @php
                     $advance = 'admin/advance_salary';   
                     $salary  = 'admin/salary';   
                     $list    = 'admin/salary/paid_list';   
                @endphp
                <li>
                    <a href="#salary" data-toggle="collapse" class="{{Request::is($advance)||Request::is($salary)||Request::is($list)?'active':'collapsed'}}" aria-expanded="{{Request::is($advance)||Request::is($salary)||Request::is($list)?'true':'false'}}"><i class="fa fa-calendar"></i> <span>Salary(EMP)</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="salary" class="{{Request::is($advance)||Request::is($salary)||Request::is($list)?'collapse in':'collapse'}}" aria-expanded="{{Request::is($advance)||Request::is($salary)||Request::is($list)?'true':'false'}}">
                        <ul class="nav">
                            <li><a href="{{URL::to('admin/advance_salary')}}" class="{{request()->is('admin/advance_salary')?'active':'collapsed'}}">Advanced Salary</a></li>
                            <li><a href="{{route('employee.salary')}}" class="{{request()->is('admin/salary')?'active':'collapsed'}}">Pay Salary</a></li>
                            <li><a href="{{route('paid.list')}}" class="{{request()->is('admin/salary/paid_list')?'active':'collapsed'}}">Paid Salary List</a></li>
                        </ul>
                    </div>
                </li>
                @php
                     $exp = 'admin/add_expense';
                     $tod = 'admin/expense/today_expense';
                     $mon = 'admin/expense/monthly_expense';
                @endphp
                <li>
                    <a href="#expense" data-toggle="collapse" class="{{Request::is($exp)||Request::is($tod)||Request::is($mon)?'active':'collapsed'}}" aria-expanded="{{Request::is($exp)||Request::is($tod)||Request::is($mon)?'true':'false'}}"><i class="lnr lnr-file-empty"></i> <span>Expense</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="expense" class="{{Request::is($exp)||Request::is($tod)||Request::is($mon)?'collapse in':'collapse'}}" aria-expanded="{{Request::is($exp)||Request::is($tod)||Request::is($mon)?'true':'false'}}">
                        <ul class="nav">
                            <li><a href="{{route('add.expense')}}" class="{{Request::is($exp)?'active':''}}">Add Expense</a></li>
                            <li><a href="{{route('expense.today')}}" class="{{Request::is($tod)?'active':''}}">Today</a></li>
                            <li><a href="{{route('expense.monthly')}}" class="{{Request::is($mon)?'active':''}}">Monthly</a></li>
                        </ul>
                    </div>
                </li>
                @php
                     $list = 'admin/sales/list';
                @endphp
                <li>
                    <a href="#sales" data-toggle="collapse" class="collapsed" aria-expanded><i class="fa fa-life-ring" aria-hidden="true"></i><span>Sales Report</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="sales" class="collapse " aria-expanded="">
                        <ul class="nav">
                            <li><a href="{{route('sales.list')}}" class="">Manage due</a></li>
                            <li><a href="{{route('today.report')}}" class="">Today</a></li>
                            <li><a href="{{route('monthly.report')}}" class="">Monthly</a></li>
                        </ul>
                    </div>
                </li>

                @php $category = 'admin/category*'; @endphp
                <li>
                    <a href="{{URL::to('admin/category')}}" class="{{Request::is($category)?'active':''}}"><i class="fa fa-bars" aria-hidden="true"></i><span>Category</span></a>
                </li>

                @php $products = 'admin/products*'; @endphp
                <li>
                    <a href="{{URL::to('admin/products')}}" class="{{Request::is($products)?'active':''}}"><i class="fa fa-bars" aria-hidden="true"></i><span>Products</span></a>
                </li>

                @php $settings = 'admin/settings*'; @endphp
                <li>
                    <a href="{{URL::to('admin/settings')}}" class="{{Request::is($settings)?'active':''}}"><i class="lnr lnr-cog"></i> <span>Settings</span></a>
                </li>
            </ul>
        </nav>
    </div>
</div>