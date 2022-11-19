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
                    </div>
                </div>
                <div id='admins_table'></div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="portfolio-item nature mix_all" data-cat="nature" style="display: inline-block; opacity: 1;">
                        @if ($profile_img!=null)
                        @if ($Type=="Product")
                        <img src="{{asset($profile_img)}}" class="img-thumbnail"id='done' />
                        @else
                            <img src="{{asset($profile_img)}}" class="img-thumbnail" />
                        @endif 
                    @else
                    @endif
                        <div class="overlay">
                           <p>
                                <span>
                                صورة حسابك الشخصى
                                </span>
                               
                                {{$adminName}}
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    بيانات الحساب الخاص بك
                                </div>
                                
                                <div class="panel-body">
                                    <table class='table table-responsive table-bordered table-striped'>
                                        <tr>
                                            <td>
                                                تعديل الأسم
                                            </td>
                                            <td>
                                                <input type="text" name="admin_name"class='form-control' id="admin_name"value="{{$admin[0]->name}}"">
                                            </td>
                                            <td>
                                                <button type='button'class='btn btn-info'id='update_my_admin_name'>تحديث </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                تعديل البريد الألكترونى
                                            </td>
                                            <td>
                                                <input type="email"class='form-control'id='myAdmin_email'value='{{$admin[0]->email}}'>
                                            </td>
                                            <td>
                                                <button class='btn btn-info'type='button'id='update_my_admin_email'>تحديث </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                تعديل كلمة السر
                                            </td>
                                            <td>
                                                <input type="password"class='form-control'id='old_password'placeholder='أدخل كلمة السرالقديمة'>
                                                <input type="password"class='form-control'id='new_password'placeholder='أدخل كلمة السر الجديدة'>
                                            </td>
                                            <td><button class='btn btn-info'type='button'id='update_my_admin_password'>تحديث</button></td>
                                        </tr>
                                        <tr>
                                            <form action="{{route("update_admin_img")}}" method="POST"enctype="multipart/form-data">
                                                @csrf
                                                <td>
                                                    تعديل صورة الحساب الشخصى
                                                </td>
                                                <td>
                                                    <input type="file" name="new_admin_picture" id="">
                                                </td>
                                                <td>
                                                    <button class='btn btn-info' type='submit'name='save_new_img'>تحديث </button>
                                                </td>
                                            </form>
                                        </tr>
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


