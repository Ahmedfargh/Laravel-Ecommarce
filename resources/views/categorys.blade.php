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
                        <div class="col-12">
                            <div class="panel panel-info">
                                    <div class="panel-heading">
                                        أضافة تصنيف
                                    </div>
                                     <div class="panel-body">
                                        <form  method='POST'action="{{route('add_Category')}}"enctype="multipart/form-data" >
                                            @csrf
                                            <div class="form-group">
                                                <label>أسم التصنيف</label>
                                                <input class="form-control" type="text"name='category_name'id='category_name'required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>التصنيف الأب</label>
                                                <select name="parent_Class" id=""class='form-control'required>
                                                    <option value="0">لايوجد تصنيف أب</option>
                                                    @foreach ($Categories as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="submit" class="btn btn-info"value='+'>
                                        </form>
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


