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
                    <h3 class='col-12 text-center'>الطلبات الجاهزة لشحن</h3>
                    <table class="table table-striped table-bordered table-hover col-12">
                        <thead>
                            <tr>
                                <th>رقم القائمة</th>
                                <th>هل تم التأكيد</th>
                                <th>من قام بالتأكيد</th>
                                <th>عنوان المرسل إليه</th>
                                <th>رقم الطلب</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($ready_orders as $order)
                            <tr>
                                <td>
                                    {{$order->cart_id}}
                                </td>
                                <td>
                                    @if ($order->is_checked)
                                        تم الفحص و التأكيد
                                    @else
                                        لم يت الفحص و التأكيد
                                    @endif
                                </td>
                                <td>
                                    @if($order->checked_id)
                                        {{$order->checked_id}}
                                    @else
                                        لا يوجد أدمن
                                    @endif
                                </td>
                                <td>
                                    {{$order->send_to_address}}
                                </td>
                                <td>
                                    {{$order->order_id}}
                                </td>
                            </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <h3 class='col-12 text-center'>الطلبات التى تحتاج إلى فحص</h3>
                    <table class="table table-striped table-bordered table-hover col-12">
                        <thead>

                            <td>
                                رقم الطلب
                            </td>
                            <td>
                                رقم القائمة
                            </td>
                            <td>
                                هل تم الفحص
                            </td>
                            <td>
                                من قام بالتأكيد
                            </td>
                            <td>
                                عنوان المرسل إليه
                            </td>
                        </thead>
                        <tbody>
                        @foreach ($uncheckiedOrders as $order)
                            <tr>
                                <td>
                                    {{$order->order_id}}
                                </td>
                                <td>
                                    {{$order->cart_id}}
                                </td>
                                <td>
                                    @if ($order->is_checked)
                                        تم الفحص و التأكيد
                                    @else
                                        لم يت الفحص و التأكيد
                                    @endif
                                </td>
                                <td>
                                    @if($order->checked_id)
                                        {{$order->checked_id}}
                                    @else
                                        لا يوجد أدمن
                                    @endif
                                </td>
                                <td>
                                    {{$order->send_to_address}}
                                </td>
                                <td>
                                    <button class='btn btn-info'onclick="alert({{$order->order_id}})"type='button'>تأكيد</button>
                                </td>
                                <td>
                                    <button class='btn btn-info'onclick="alert({{$order->order_id}})"type='button'>عرص بيانات العميل</button>
                                </td>
                            </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    
@include("footer")


