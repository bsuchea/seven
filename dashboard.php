<?php
require_once 'config/checklogin.php';
require_once 'config/db.php';
require_once 'inc/html_head.php';
?>
<body class="app">
<header class="app-header fixed-top">

    <!-- ::: Header Menu ::: -->
    <div class="app-header-inner">
        <?php include('inc/header_menu.php') ?>
    </div>
    </div>
    <div id="app-sidepanel" class="app-sidepanel">
        <?php include('inc/sidebar.php') ?>
    </div><!--//app-sidepanel-->
</header><!--//app-header-->

<!-- ::: Main Content ::: -->
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 style="font-family: 'Kh Dangrek'; color:#15a362; font-size:large" class="app-page-title">ទំព័រដើម</h1>

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-1">
                        <h4 style="font-family: 'Kh Dangrek'" class="mb-2">សូមស្វាគមន៍</h4>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-12">
                                <div style="font-family: 'Kh Dangrek'">មកកាន់ប្រព័ន្ធគ្រប់គ្រងហាង​ Se7eN Esport
                                    ដែលប្រព័ន្ធគ្រប់គ្រងនេះត្រូវបានបង្កើតឡើងក្នុងគោលបំណងបំពេញតម្រូវការរបស់ហាង
                                </div>
                            </div><!--//col-->
                        </div><!--//row-->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div><!--//app-card-body-->

                </div><!--//inner-->
            </div><!--//app-card-->
            <?php include('contents/slide.php'); ?>
        </div><!--//container-fluid-->
    </div><!--//app-content-->


    <footer id="footbarlog" class="app-footer">
        <?php include('inc/footer.php') ?>
    </footer><!--//app-footer-->

</div>

<!-- ::: My Script ::: -->
<?php include('contents/My_Scripts.php') ?>

</body>
</html> 

