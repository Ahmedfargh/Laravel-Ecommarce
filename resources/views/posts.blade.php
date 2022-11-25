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
                
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-12">

                        <div class="panel panel-success">
                            <div class="panel-heading">
                               Message Box #1
                            </div>
                            <div class="panel-body" style="padding: 0px;">
                                <!---
                                <div class="chat-widget-main">
                                    <div class="chat-widget-left">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </div>
                                    <div class="chat-widget-name-left">
                                        <h4>Amanna Seiar</h4>
                                    </div>
                                    <div class="chat-widget-right">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </div>
                                    <div class="chat-widget-name-right">
                                        <h4>Donim Cruseia </h4>
                                    </div>
                                    <div class="chat-widget-left">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </div>
                                    <div class="chat-widget-name-left">
                                        <h4>Amanna Seiar</h4>
                                    </div>
                                    <div class="chat-widget-right">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </div>
                                    <div class="chat-widget-name-right">
                                        <h4>Donim Cruseia </h4>
                                    </div>
                                    
                                </div>-->
                                <div class="chat-widget-main">
                                    @foreach ($posts as $post)
                                    <div class="chat-widget-right">
                                        {{$post->post_cotent}}
                                    </div>
                                    <div class="chat-widget-name-right">
                                        <h4>{{$post->name}} فى {{$post->post_date}} </h4>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="أدخل الرسالة"id='upload_message'>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="button"id='upload_post'>أنشر المنشور</button>
                                    </span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class='row'>
                    <div class='col-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                جدول التصنيفات
                            </div>
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-hover"id='look_for_products'>
                                        <thead>
                                            <tr>
                                                <td>
                                                    رقم الصنيف
                                                </td>
                                                <td>
                                                    أسم التصنيف
                                                </td>
                                                <td>
                                                    رقم التصنيف الأب
                                                </td>
                                            </tr>
                                        </thead>
                                        @foreach ($Categories as $cat)
                                        <tr>
                                            <td>
                                                {{$cat->id}}
                                            </td>
                                            <td>
                                                {{$cat->name}}
                                            </td>
                                            <td>
                                                {{$cat->parent_cat}}
                                            </td>
                                       
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-12'>
                        <div class='panel panel-default'>
                            <div class="panel-heading">
                                تحديث التصنيف
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover"id='update-product'>
                                    <thead>
                                        <tr>
                                            <td>
                                                رقم التصنيف
                                            </td>
                                            <td>
                                                <input type="number" name="" id="category_class"class='form-control'>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>تحديث الأسم</td>
                                        <td><input type='text'class='form-control'id='new_update_cat_name'placeholder='ادخل الأسم الجديد لمنتج'></td>
                                        <td><button class='btn btn-warning'type='button'id='update_cat_name'>تحديث </button></td>
                                    </tr>

                                    <tr>
                                        <td>تحديث الصنف الأب</td>
                                        <td>
                                            <select name="parent_cat" id="update_newparent_cat"class='form-control' required>
                                                @foreach ($Categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><button class='btn btn-warning'type='button'id='update_parent_cat'>تحديث </button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class='btn btn-danger'id='delete_cat_product'type='button'>حذف</button>
                                        </td>
                                    </tr>
                                </table>
                                
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


