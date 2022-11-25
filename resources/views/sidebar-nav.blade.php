<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">   
            <li>
                <div class="user-img-div">
                    @if ($profile_img!=null)
                        @if ($Type=="Product")
                        <img src="{{asset($profile_img)}}" class="img-thumbnail"id='done' />
                        @else
                            <img src="{{asset($profile_img)}}" class="img-thumbnail" />
                        @endif 
                    @else
                        <img src="assets/img/user.png" class="img-thumbnail" />   
                    @endif
                    <div class="inner-text">
                        {{$adminName}}
                    <br />
                        <small>Last Login : 2 Weeks Ago </small>
                    </div>
                </div>

            </li>
            <li>
                <a class="active-menu" href="#"><i class="fa fa-square-o "></i>الرئيسية</a>
            </li>
            <li>
                <a class="" href='{{route("product_page")}}''><i class="fa fa-square-o "></i>صفحة المنتجات</a>
            </li>
            <li>
                <a  href="{{route('admin_account')}}"><i class="fa fa-dashboard "></i>حسابى </a>
            </li>
            
            <li>
                <a href='{{route("category_bord")}}'>التصنيفات</a>
            </li>
            <li>
                <a href="{{route('admin_post')}}">منشورات الأدمن</a>
            </li>
             <li>
                <a href="#"><i class="fa fa-yelp "></i>Extra Pages <span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level">
                    <li>
                        <a href="invoice.html"><i class="fa fa-coffee"></i>Invoice</a>
                    </li>
                    <li>
                        <a href="pricing.html"><i class="fa fa-flash "></i>Pricing</a>
                    </li>
                     <li>
                        <a href="component.html"><i class="fa fa-key "></i>Components</a>
                    </li>
                     <li>
                        <a href="social.html"><i class="fa fa-send "></i>Social</a>
                    </li>
                    
                     <li>
                        <a href="message-task.html"><i class="fa fa-recycle "></i>Messages & Tasks</a>
                    </li>
                    
                   
                </ul>
            </li>
            <li>
                <a href="table.html"><i class="fa fa-flash "></i>Data Tables </a>
                
            </li>
            <li>
                <a href="#"><i class="fa fa-bicycle "></i>Forms <span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level">
                   
                     <li>
                        <a href="form.html"><i class="fa fa-desktop "></i>Basic </a>
                    </li>
                     <li>
                        <a href="form-advance.html"><i class="fa fa-code "></i>Advance</a>
                    </li>
                     
                   
                </ul>
            </li>
             <li>
                <a href="gallery.html"><i class="fa fa-anchor "></i>Gallery</a>
            </li>
             <li>
                <a href="error.html"><i class="fa fa-bug "></i>Error Page</a>
            </li>
            <li>
                <a href="login.html"><i class="fa fa-sign-in "></i>Login Page</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap "></i>Multilevel Link <span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><i class="fa fa-bicycle "></i>Second Level Link</a>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-flask "></i>Second Level Link</a>
                    </li>
                    <li>
                        <a href="#">Second Level Link<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#"><i class="fa fa-plus "></i>Third Level Link</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-comments-o "></i>Third Level Link</a>
                            </li>

                        </ul>

                    </li>
                </ul>
            </li>

        </ul>
    </div>

</nav>