</div>
</div>
<footer class="footer">
<div class="container-fluid">

        <p class="copyright text-center">
            ©R
            <script>
                document.write(new Date().getFullYear())
            </script>
            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
        </p>
    </nav>
</div>
</footer>
</div>
</div>

<div class="fixed-plugin">
<div class="dropdown show-dropdown">
   <a href="#" data-toggle="dropdown">
       <i class="fa fa-cog fa-2x"> </i>
   </a>

   <ul class="dropdown-menu">
 <li class="header-title"> Sidebar Style</li>
       <li class="adjustments-line">
           <a href="javascript:void(0)" class="switch-trigger">
               <p>Background Image</p>
               <label class="switch">
                   <input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
               </label>
               <div class="clearfix"></div>
           </a>
       </li>
       <li class="adjustments-line">
           <a href="javascript:void(0)" class="switch-trigger background-color">
               <p>Filters</p>
               <div class="pull-right">
                   <span class="badge filter badge-black" data-color="black"></span>
                   <span class="badge filter badge-azure" data-color="azure"></span>
                   <span class="badge filter badge-purple active" data-color="purple"></span>
               </div>
               <div class="clearfix"></div>
           </a>
       </li>
       <li class="header-title">Sidebar Images</li>

       <li class="active">
           <a class="img-holder switch-trigger" href="javascript:void(0)">
               <img src="<?php echo $config['admin_assets']?>/img/sidebar-1.jpg" alt="" />
           </a>
       </li>
       <li>
           <a class="img-holder switch-trigger" href="javascript:void(0)">
               <img src="<?php echo $config['admin_assets']?>/img/sidebar-3.jpg" alt="" />
           </a>
       </li>
       <li>
           <a class="img-holder switch-trigger" href="javascript:void(0)">
               <img src="<?php echo $config['admin_assets']?>/img/sidebar-4.jpg" alt="" />
           </a>
       </li>
       <li>
           <a class="img-holder switch-trigger" href="javascript:void(0)">
               <img src="<?php echo $config['admin_assets']?>/img/sidebar-5.jpg" alt="" />
           </a>
       </li>


   </ul>
</div>
</div>

</body>
<!--   Core JS Files   -->
<script src="<?php echo $config['admin_assets']?>/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $config['admin_assets']?>/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php echo $config['admin_assets']?>/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?php echo $config['admin_assets']?>/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="<?php echo $config['admin_assets']?>/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo $config['admin_assets']?>/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="<?php echo $config['admin_assets']?>/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo $config['admin_assets']?>/js/demo.js"></script>


</html>
