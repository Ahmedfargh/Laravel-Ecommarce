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
                                        إضافة أدمن
                                     </div>
                                     <div class="panel-body">
                                        <form  method='POST'action="{{route('add_product')}}"enctype="multipart/form-data" >
                                            @csrf
                                            <div class="form-group">
                                                <label>أسم المنتج</label>
                                                <input class="form-control" type="text"name='productname'id='productname'required>
                                                <p class="help-block">أسم المنتج</p>
                                            </div>
                                            <div class="form-group">
                                                <label>سعر المنتج</label>
                                                <input class="form-control" type="number"name='product_price'id="product_price"required>
                                                <p class="help-block">سعر المنتج</p>
                                            </div>
                                            <div class="form-group">
                                                <label>العدد المتاح</label>
                                                <input type="number" name="Product_quantity" id="productquantity"class='form-control'required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">القسم التابع له المنتج</label>
                                                <select name="parent_cat" id="product_category"class='form-control' required>
                                                    @foreach ($Categories as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label for="">صورة للمنتج </label>
                                                <input type="file" name="Product_img"id="Product_img"required>
                                            <div class='form-group'>
                                                
                                            </div>
                                            <div class='form-group'>
                                                <label>وصف المنتج</label>
                                                <textarea name="product_desc" id="product_desc" cols="30" rows="10"class='form-control'></textarea>
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
                                البحث عن منتج
                            </div>
                            
                            <div class="panel-body">
                                    <input type="text" name="" id="key_name"class='form-control'>
                                    <button class='btn btn-info col-4'id='btn_search_name'type='button'>أبحث بالأسم</button>
                                    <select name="parent_cat" id="key_Category"class='form-control' required>
                                        @foreach ($Categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    <button class='btn btn-info col-4'id='btn_search_cat'type='button'>أبحث بالتصنيف</button>
                                    <input type="text" name="" id="key_added_by"class='form-control'>
                                    <button class='btn btn-info col-4'id='btn_search_added_by'type='button'>أبحث بأسم الأدمن</button>
                                <div class="table-responsive">
                                    <table class="table table-hover"id='look_for_products'>
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


