<style>
    .admin_logo{
        height: 40px;
        width: 40px;
    }
</style>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{ Route('staff-dashboard') }}">
                <img src="{{ URL::asset('public/frontend/images/logo.png') }}" style="margin-top: 17px;" width="130" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <!--        <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-circle btn-outline red dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-docs"></i> New Post </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-tag"></i> New Comment </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-share"></i> Share </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-flag"></i> Comments
                                    <span class="badge badge-success">4</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-users"></i> Feedbacks
                                    <span class="badge badge-danger">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>-->
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <!--            <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." name="query">
                                <span class="input-group-btn">
                                    <a href="javascript:;" class="btn submit">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </span>
                            </div>
                        </form>-->
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            @php
                            $models=App\Notification::where('notify_view_users','=','staff')->wherestatus('0')->orderBy('id', 'DESC')->get();
                            $notification_count=count($models);
                            @endphp
                            <span class="badge badge-default"> {{$notification_count}} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    @if($notification_count>0)
                                    <span class="bold">{{$notification_count}} pending</span> notifications</h3>
                                     @endif
                                <a href="{{ Route('staff-notifications') }}">view all</a>
                            </li>
                            @if(count($models)>0)
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    @foreach($models as $model)
                                    @php 
                                    $datetime=$model->created_at;
                                    $full = false;
                                    $now = new DateTime;
                                    $ago = new DateTime($datetime);
                                    $diff = $now->diff($ago);

                                    $diff->w = floor($diff->d / 7);
                                    $diff->d -= $diff->w * 7;

                                    $string = array(
                                    'y' => 'year',
                                    'm' => 'month',
                                    'w' => 'week',
                                    'd' => 'day',
                                    'h' => 'hour',
                                    'i' => 'minute',
                                    's' => 'second',
                                    );
                                    foreach ($string as $k => &$v) {
                                    if ($diff->$k) {
                                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                    } else {
                                    unset($string[$k]);
                                    }
                                    }

                                    if (!$full) $string = array_slice($string, 0, 1);
                                    $time= $string ? implode(', ', $string) : 'just now';
                                    @endphp
                                    @if($model->type=='6')
                                    <li>
                                        <a href="javascript:void(0);"  data-location="{{ Route('staff-products') }}" onclick="changenotistatus('{{$model->id}}',this);">
                                            <span class="time">{{$time}}</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="icon-equalizer"></i>
                                                    <span>  <b>{{str_limit($model->notify_msg,18)}}</b></span>  
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    @elseif($model->type=='7')
                                    <li>
                                        <a  href="javascript:void(0);"  data-location="{{ Route('staff-deal-adverts') }}" onclick="changenotistatus('{{$model->id}}',this);">
                                            <span class="time">{{$time}}</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-ticket"></i>
                                                    <span>  <b>{{str_limit($model->notify_msg,18)}}</b></span>                        
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    @elseif($model->type=='8')
                                    <li>
                                        <a  href="javascript:void(0);"  data-location="{{ Route('staff-voucher-adverts') }}" onclick="changenotistatus('{{$model->id}}',this);">
                                            <span class="time">{{$time}}</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-ticket"></i>
                                                    <span>  <b>{{str_limit($model->notify_msg,18)}}</b></span>                        
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            No new notification found!
                            @endif
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!--                    <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <i class="icon-envelope-open"></i>
                                                <span class="badge badge-default"> 4 </span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="external">
                                                    <h3>You have
                                                        <span class="bold">7 New</span> Messages</h3>
                                                    <a href="app_inbox.html">view all</a>
                                                </li>
                                                <li>
                                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="{{ URL::asset('public/backend/assets/layouts/layout3/img/avatar2.jpg') }}" class="img-circle" alt=""> </span>
                                                                <span class="subject">
                                                                    <span class="from"> Lisa Wong </span>
                                                                    <span class="time">Just Now </span>
                                                                </span>
                                                                <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="{{ URL::asset('public/backend/assets/layouts/layout3/img/avatar3.jpg') }}" class="img-circle" alt=""> </span>
                                                                <span class="subject">
                                                                    <span class="from"> Richard Doe </span>
                                                                    <span class="time">16 mins </span>
                                                                </span>
                                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="{{ URL::asset('public/backend/assets/layouts/layout3/img/avatar1.jpg') }}" class="img-circle" alt=""> </span>
                                                                <span class="subject">
                                                                    <span class="from"> Bob Nilson </span>
                                                                    <span class="time">2 hrs </span>
                                                                </span>
                                                                <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="{{ URL::asset('public/backend/assets/layouts/layout3/img/avatar2.jpg') }}" class="img-circle" alt=""> </span>
                                                                <span class="subject">
                                                                    <span class="from"> Lisa Wong </span>
                                                                    <span class="time">40 mins </span>
                                                                </span>
                                                                <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="photo">
                                                                    <img src="{{ URL::asset('public/backend/assets/layouts/layout3/img/avatar3.jpg') }}" class="img-circle" alt=""> </span>
                                                                <span class="subject">
                                                                    <span class="from"> Richard Doe </span>
                                                                    <span class="time">46 mins </span>
                                                                </span>
                                                                <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>-->
                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN TODO DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!--                    <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <i class="icon-calendar"></i>
                                                <span class="badge badge-default"> 3 </span>
                                            </a>
                                            <ul class="dropdown-menu extended tasks">
                                                <li class="external">
                                                    <h3>You have
                                                        <span class="bold">12 pending</span> tasks</h3>
                                                    <a href="app_todo.html">view all</a>
                                                </li>
                                                <li>
                                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">New release v1.2 </span>
                                                                    <span class="percent">30%</span>
                                                                </span>
                                                                <span class="progress">
                                                                    <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">40% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">Application deployment</span>
                                                                    <span class="percent">65%</span>
                                                                </span>
                                                                <span class="progress">
                                                                    <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">65% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">Mobile app release</span>
                                                                    <span class="percent">98%</span>
                                                                </span>
                                                                <span class="progress">
                                                                    <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">98% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">Database migration</span>
                                                                    <span class="percent">10%</span>
                                                                </span>
                                                                <span class="progress">
                                                                    <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">10% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">Web server upgrade</span>
                                                                    <span class="percent">58%</span>
                                                                </span>
                                                                <span class="progress">
                                                                    <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">58% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">Mobile development</span>
                                                                    <span class="percent">85%</span>
                                                                </span>
                                                                <span class="progress">
                                                                    <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">85% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <span class="task">
                                                                    <span class="desc">New UI release</span>
                                                                    <span class="percent">38%</span>
                                                                </span>
                                                                <span class="progress progress-striped">
                                                                    <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">38% Complete</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>-->
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        @php
                        $staff = Auth::guard('staff')->user();
                        @endphp
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle admin_logo" src="{{ URL::asset('public/uploads/staff/profile_picture/thumb/' . $staff->image) }}" onerror="this.src='{{ URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}'" />
                            <span class="username username-hide-on-mobile"> {{ ((isset($staff->full_name) && $staff->full_name !== NULL) ? $staff->full_name : "Not Given") }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ Route('staff-myprofile') }}">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="{{ Route('staff-logout', ['type' => 'lock']) }}">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li>
                            <li>
                                <a href="{{ Route('staff-logout') }}">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <!--                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                            <span class="sr-only">Toggle Quick Sidebar</span>
                                            <i class="icon-logout"></i>
                                        </li>-->
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>