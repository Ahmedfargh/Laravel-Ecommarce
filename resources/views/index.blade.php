@include('header')
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Ranin</a>
            </div>
            <div class="header-right">
              <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
                <a href="login.html" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        @include("sidebar-nav")
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">مرحبا بك 
                            
                            {{$adminName}}
                        </h1>
                        <h1 class="page-subhead-line">هنا التحكم الكامل بالموقع</h1>

                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="#">
                                <i class="fa fa-bolt fa-5x"></i>
                                <h5 id='admin_counter'>عدد الأدمن</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="#">
                                <i class="fa fa-bolt fa-5x"></i>
                                <h5 id='user_counters'>عدد المستخدمين</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="#">
                                <i class="fa fa-plug fa-5x"></i>
                                <h5 id='under_shopping_user'>عدد المستخدممين الذين يتسوقون الأن</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-12">
                        <div class="col-12">
                            <div class="panel panel-info">
                                    <div class="panel-heading">
                                        إضافة أدمن
                                     </div>
                                     <div class="panel-body">
                                         <form role="form">
                                            @csrf
                                        <div class="form-group">
                                            <label>أسم الأدمن</label>
                                            <input class="form-control" type="text"name='AdminName'id='AdminName'>
                                            <p class="help-block">أدخل أسم الأدمن هنا</p>
                                        </div>
                                        <div class="form-group">
                                            <label>البريد الألكترونى</label>
                                            <input class="form-control" type="email"name='AdminEmail'id="AdminEmail">
                                            <p class="help-block">أدخل أسم البريد الألكترونى</p>
                                        </div>
                                        <div class="form-group">
                                            <label>كلمة المرور</label>
                                            <input type='password'name='admin_password'class='form-control'id='password'placeholder='أدخل كلمة المرور'>
                                        </div>
                                        <div class="form-group">
                                            <label>تأكيد كلمة المرور</label>
                                            <input type='password'name='admin_password_confirmation'class='form-control'id='password_confirm'placeholder='نرجو تأكيد كلمة المرور'>
                                        </div>
                                        <button type="button" class="btn btn-info"id='btn_add_admin'><span class='fa fa-plus'></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                الأدمنز
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover"id='admins_table'>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    
@include("footer")


