<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صغحة الدخول للمديرين فقط</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="assets/img/logo-invoice.png" />
            </div>
        </div>
         <div class="row ">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form"method='POST'action="{{route('index_page')}}">
                                    @csrf
                                    <hr />
                                    <h4 class='text-center'>أدخل البيانات</h4>
                                       <br />
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                        <input type="text" class="form-control" placeholder="أسمك "name='adminname'/>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                        <input type="password" class="form-control"  placeholder="كلمة المرور"name='password' />
                                    </div>
                                    <div class="form-group">
                                        <span class="pull-right">
                                                <a href="index.html" >Forget password ? </a> 
                                        </span>
                                    </div>
                                     <button class="btn btn-primary">أدخل</button>
                                    <hr />
                                    
                                    </form>
                            </div>
                           
                        </div>
        </div>
    </div>

</body>
</html>
