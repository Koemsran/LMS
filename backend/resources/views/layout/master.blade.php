@include("layout.header")

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange">
         <!-- sidebar -->
        @include("layout.sidebar")
          <!-- end -->
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include("layout.navbar")
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
                
            </div>
            <div class="content">
                <!-- content -->
                 @yield("content")
            </div>
            <footer class="footer">
                <!-- <footer -->
                 @include("layout.footer")
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-dashboard.js?v=1.0.1"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>

</html>
