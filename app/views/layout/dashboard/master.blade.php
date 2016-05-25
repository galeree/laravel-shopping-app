<!doctype html>
<html lang="EN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Admin Panel</title>
	
	{{ HTML::style('admin/css/bootstrap.min.css') }}
	{{ HTML::style('admin/css/sb-admin.css') }}
	{{ HTML::style('admin/css/plugins/morris.css') }}
	{{ HTML::style('admin/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('css/session/style.css') }}
    {{ HTML::script('js/angular.min.js') }}
    {{ HTML::script('js/ui-bootstrap-tpls-0.12.0.min.js')}}
    {{ HTML::script('admin/js/jquery.js') }}
    {{ HTML::script('js/angular-file-upload.min.js') }}

</head>
<body>
	
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::route('dashboard.index') }}">Dashboard</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{ URL::route('dashboard.index') }}" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Confide::user()?Confide::user()->username:'guest' }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL::to('users/logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                    	<a href="javascripts:;" data-toggle="collapse" data-target="#products"><i class="fa fa-fw fa-shopping-cart"></i> Product <i class="fa fa-fw fa-caret-down"></i></a>
                    	<ul id="products" class="collapse">
                    		<li>
                    			<a href="{{ URL::route('product.index') }}">View All</a>
                    			<a href="{{ URL::route('product.create') }}">Create</a>
                    		</li>
                    	</ul>
                    </li>
                    <li>
                        <a href="javascripts:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-fw fa-folder-open"></i> Category <i class="fa fa-fw fa-caret-down"></i></a>
                    	<ul id="categories" class="collapse">
                    		<li>
                    			<a href="{{ URL::route('category.index') }}">View All</a>
                    			<a href="{{ URL::route('category.create') }}">Create</a>
                    		</li>
                    	</ul>
                    </li>
                    <li>
                        <a href="javascripts:;" data-toggle="collapse" data-target="#gallery"><i class="fa fa-fw fa-image"></i> Gallery <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="gallery" class="collapse">
                            <li>
                                <a href="{{ URL::route('gallery.index') }}">View All</a>
                                <a href="{{ URL::route('gallery.create') }}">Create</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> User</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
            	@yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    {{ HTML::script('js/category_manager.js') }}
    {{ HTML::script('js/product_manager.js') }}
    {{ HTML::script('js/gallery_manager.js') }}
    {{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js') }}
    {{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js') }}
    {{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js') }}
    {{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js') }}
    {{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/localization/messages_TH.js') }}
	{{ HTML::script('admin/js/bootstrap.min.js')}}
    {{ HTML::script('js/form.js') }}
	{{ HTML::script('admin/js/plugins/morris/raphael.min.js') }}
	{{ HTML::script('admin/js/plugins/morris/morris.min.js') }}
	{{ HTML::script('admin/js/plugins/morris/morris-data.js') }}
</body>
</html>