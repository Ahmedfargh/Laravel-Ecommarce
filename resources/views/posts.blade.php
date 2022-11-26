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
                                مراسلات الجميع
                            </div>
                            <div class="panel-body" style="padding: 0px;">
                                <div class="chat-widget-main">
                                    @foreach ($posts as $post)
                                        @if ($post->writer==$_SESSION["admin_id"])
                                            <div class="chat-widget-left">
                                                {{$post->post_cotent}}
                                            </div>
                                            <div class="chat-widget-name-left">
                                                <h4>{{$post->name}} فى {{$post->post_date}} </h4>
                                            </div>   
                                        @else
                                            <div class="chat-widget-right">
                                                {{$post->post_cotent}}
                                            </div>
                                            <div class="chat-widget-name-right">
                                                <h4>{{$post->name}} فى {{$post->post_date}} </h4>
                                            </div>
                                        @endif
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
                    <div class="col-12">

                        <div class="panel panel-success">
                            <div class="panel-heading">
                               مرسالاتك مع الأدمن 
                               <select name="" id="second_admin">
                                    @foreach ($admins as $admin)
                                        <option value="{{$admin->adm_id}}">{{$admin->adm_name}}({{$admin->adm_id}})</option>
                                    @endforeach
                               </select>
                            </div>
                            <div class="panel-body" style="padding: 0px;">
                                <div class="chat-widget-main"id='private_chat'>
                                   
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="أدخل الرسالة"id='sent_message'>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="button"id='send_message'>أرسل الرسالة</button>
                                    </span>
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


