<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="ar"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="ar"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="ar"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="UTF-8">
    <title>Easy Deals</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#00A105" />

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/vendor.css">

    <!-- favicons
     ================================================== -->
    <link rel="icon" type="text/png" href="images/Icon.png" >

</head>

<body id="top">
<?php include "db.php"; 
include_once("Info/analytics.php");
include_once ("Info/Checking.php");
?>
<!-- header
================================================== -->
<header>
    <div class="row">
        <div class="logo">
            <a href="index.php"></a>
        </div>

        <nav id="main-nav-wrap">
            <ul class="main-navigation">
                <li class="current"><a class="smoothscroll"  href="#intro" title="">الصفحة الرئيسية</a></li>
                <!--<li><a class="smoothscroll"  href="#process" title="كيف يعمل"><span>كيف يعمل؟</span></a></li> -->
                <li><a class="smoothscroll"  href="#main_features" title="">أهم المميزات</a></li>
                <li><a class="smoothscroll"  href="#pricing" title="">الأسعار</a></li>
                <li><a href="Login.php" title="">تسجيل دخول</a></li>
                <li class="highlight with-sep"><a href="register/Registration.php" title="إضغط هنا لانشاء حساب">تسجيل حساب</a></li>
            </ul>
        </nav>

        <a class="menu-toggle" href="#"><span>Menu</span></a>
    </div>
</header> <!-- /header -->

<!-- intro section
================================================== -->
<section id="intro">
    <div class="shadow-overlay"></div>
    <div class="intro-content">
        <div class="row">
            <div class="col-twelve">
                <div class='video-link'>
                    <a href="#video-popup"><img src="images/play-button.png" title="شرح بالفيديو" alt=""></a>
                </div>

                <h5>Easy Deals</h5>
                <h2 style="color: white;">لتسهيل المعاملات بين التجار وأصحاب الـشركات في فلسطين</h2>

                <a class="button stroke smoothscroll" href="#main_features" title="إضغط لمزيد من التفاصيل" style="font-weight: bold;">إبـــــــدأ</a>

            </div>
        </div>
    </div>

    <!-- Modal Popup
    ========================================================= -->

    <div id="video-popup" class="popup-modal mfp-hide">
        <div class="fluid-video-wrapper">
            <iframe src="#" width="500" height="281" frameborder="0" allowfullscreen></iframe>
        </div>

        <a class="close-popup">Close</a>

    </div> <!-- /video-popup -->
</section> <!-- /intro -->


<!-- Process Section
==================================================
<section id="process">
    <div class="row section-intro">
        <div class="col-twelve with-bottom-line">
            <h5>Creat account</h5>
            <h1>كيف يعمل ؟</h1>

            <p class="lead">----------</p>
        </div>
    </div>

    <div class="row process-content">
        <div class="left-side">
            <div class="item" data-item="1">
                <h5>إنشاء حساب</h5>

                <p>وصف</p>
            </div>

            <div class="item" data-item="2">

                <h5>Main features</h5>

                <p>..........</p>

            </div>
        </div>

        <div class="right-side">
            <div class="item" data-item="3">
                <h5>Create</h5>

                <p>..................................................................</p>

            </div>

            <div class="item" data-item="4">
                <h5>Publish</h5>

                <p>..................................................................</p>

            </div>
        </div>

        <div class="image-part"></div>

    </div>
</section>

-->
<!-- features Section
================================================== -->
<section id="main_features" style="background-color: white;">
    <div class="row section-intro">
        <div class="col-twelve with-bottom-line">

            <!-- <h5>الميزات</h5> --><br><br>
            <h1>أهم ما يميز نظامنا</h1>

            <p class="lead">يتوفر الموقع على مجموعة من المزايا كما هو موضح بالاسفل</p>

        </div>
    </div>

    <div class="row features-content">
        <div class="features-list block-1-3 block-s-1-2 block-tab-full group">
            <div class="bgrid feature">
                <span class="icon"><i class="icon-window"></i></span>
                <div class="service-content">

                    <h3 class="h05">الـرسـائـل الـفـوريـة</h3>
                    <p>
                        يتوفر الموقع على ميزة التراسل الفوري بين التاجر وصاحب السلعة تلك الميزة تسهل عملية التواصل بين التاجر والـشـركـة, بـالإضـافـة الى أنـه يـمـكـن لـمـديـر الـشـركـة الـتـواصـل مـع الإداريـيـن داخـل الـشـركـة
                    </p>
                </div>
            </div> <!-- /bgrid -->

            <div class="bgrid feature">

                <span class="icon"><i class="icon-eye"></i></span>

                <div class="service-content">
                    <br><br><br><br><br>
                    <h3 class="h05">إختيار المنتجات والـطـلـبات</h3>

                    <p>
                        بـإمـكـان الـتـاجـر البحث عن بـضـائـع ومـعـرفـة تـفـاصـيـلها من عدة شركات واختيار البضاعة المناسبة له بإ رسال طلب وبطريقة الدفع الـتـي يـريـدهـا ( شـيـك ,كـاش ,تـقـسـيـط ) لـيـتـم الـرد مـن الـشـركـة الـمـسـؤولـة عـن الـبـضـائـع الـمـطـلـوبـة بالـقـبـول أو الـرفـض
                    </p>

                </div>
            </div> <!-- /bgrid -->

            <div class="bgrid feature">

                <span class="icon"><i class="icon-paint-brush"></i></span>

                <div class="service-content">
                    <h3 class="h05">الإشعارات والتنبيهات</h3>

                    <p>
                        يتوصل التاجر والمستورد على التنبيهات والاشعارات بشكل الي في عدت حالات كإقتراب استحقاق الدفع لفاتورة معينة أو إقتراب صرف شيك بالاضافة الى انه سيكون هناك رسائل sms
                    </p>

                </div>
            </div> <!-- /bgrid -->
            <div class="bgrid feature">

                <span class="icon"><i class="icon-file"></i></span>

                <div class="service-content">
                    <h3 class="h05">إضـافـة مـسـؤولـيـن لـلـشـركـة</h3>

                    <p>
                        بـإمـكـان مـسـؤول الـشـركـة إضـافـة عـدة إداريـيـن أو مـسـؤولـيـن سـواء مـدراء بـضـائـع أو مـدراء مـالـيـيـن وكلٌ مـنـهـم مـسـؤول عـن دوره فـي الـشـركـة
                    </p>

                </div>
            </div> <!-- /bgrid -->

            <div class="bgrid feature">

                <span class="icon"><i class="icon-layers"></i></span>

                <div class="service-content">


                </div>
            </div> <!-- /bgrid -->

            <div class="bgrid feature">

                <span class="icon"><i class="icon-gift"></i></span>

                <div class="service-content">
                    <h3 class="h05">الفواتير والدفعات</h3>

                    <p>
                        فـي حـال تـم الـموافـقة من الـمـسـتـورد على طـلـب الـتـاجـر سـيـقـوم النـظـام بـإنـشـاء فـاتـورة بـتـاريـخ بـدايـة ونـهـايـة الـتـي يـتـم تـحـديـدهـا مـن قـبـل الـمـسـتـورد الـفـاتـورة وطـريـقـة الـدفـع بالإضـافـة إلـى تـفـاصـيل الـطـلب
                    </p>


                </div>
            </div> <!-- /bgrid -->
        </div> <!-- features-list -->
    </div> <!-- features-content -->
</section> <!-- /features -->


<!-- pricing
================================================== -->

<section id="pricing">
    <div class="row section-intro">
        <div class="col-twelve with-bottom-line">

            <h5>أسعارنا</h5>
            <h1>إخـتـر خـطـتـك</h1>

            <p class="lead">لـديـنـا أسـعـار تـنـاسـب الـجـمـيـع</p>
        </div>
    </div>

    <div class="row pricing-content">
        <div class="pricing-tables block-1-4 group">
            <!--
             <div class="bgrid">

                 <div class="price-block">
                     <div class="top-part">

                         <h3 class="plan-title">Starter</h3>
                         <p class="plan-price"><sup>$</sup>4.99</p>
                         <p class="price-month">Per month</p>
                         <p class="price-meta">Billed Annually.</p>

                     </div>

                     <div class="bottom-part">
                         <ul class="features">
                             <li><strong>3GB</strong> Storage</li>
                             <li><strong>10GB</strong> Bandwidth</li>
                             <li><strong>5</strong> Databases</li>
                             <li><strong>30</strong> Email Accounts</li>
                         </ul>

                         <a class="button large" href="">Get Started</a>

                     </div>
                 </div>
             </div>

             <div class="bgrid">
                 <div class="price-block primary">
                     <div class="top-part" data-info="recommended">

                         <h3 class="plan-title">Standard</h3>
                         <p class="plan-price"><sup>$</sup>9.99</p>
                         <p class="price-month">Per month</p>
                         <p class="price-meta">Billed Annually.</p>

                     </div>

                     <div class="bottom-part">
                         <ul class="features">
                             <li><strong>5GB</strong> Storage</li>
                             <li><strong>15GB</strong> Bandwidth</li>
                             <li><strong>7</strong> Databases</li>
                             <li><strong>40</strong> Email Accounts</li>
                         </ul>

                         <a class="button large" href="">Get Started</a>

                     </div>
                 </div>
             </div>
                 -->
            <div class="bgrid" style="margin-left: 15%;">
                <div class="price-block">
                    <div class="top-part">

                        <h3 class="plan-title">حـسـاب شـركـة</h3>
                        <p class="plan-price"><sup>$</sup>19.99</p>
                        <p class="price-month">شهريا</p>
                        <p class="price-meta">تجربة سنة كاملة مجاناً</p>

                    </div>

                    <div class="bottom-part">
                        <ul class="features">
                            <li><strong>إشعارات وتنبيهات</strong></li>
                            <li><strong>إضافة وعرض المنتجات للتجار</strong></li>
                            <li><strong>إضافة عدد من المسؤولين للشركة</strong></li>
                            <li><strong>تواصل مع التجار</strong></li>
                        </ul>

                        <a class="button large" href="register/Company_Registration.php">تـسـجـيـل</a>
                    </div>
                </div>
            </div> <!-- /price-block -->

            <div class="bgrid" style="margin-left: 20%;">
                <div class="price-block">
                    <div class="top-part">
                        <h3 class="plan-title">حـسـاب تـاجـر</h3>
                        <p class="price-month" style=" opacity: 0.0;">.</p>
                        <p class="plan-price">مـجـانـاً</p>
                        <p class="price-meta" style=" opacity: 0.0;">.</p>
                    </div>

                    <div class="bottom-part">

                        <ul class="features">
                            <li><strong>إشعارات وتنبيهات</strong></li>
                            <li><strong>البحث عن منتجات</strong></li>
                            <li><strong>إرسال طلبات</strong></li>
                            <li><strong>تواصل مع الشركات</strong></li>
                        </ul>

                        <a class="button large" href="register/Dealer_Registration.php">تسجيل</a>
                    </div>
                </div>
            </div> <!-- /price-block -->
        </div> <!-- /pricing-tables -->
    </div> <!-- /pricing-content -->
</section> <!-- /pricing -->


<!-- Testimonials Section
================================================== -->
<section id="testimonials">
    <div class="row">
        <div class="col-twelve">
            <h2 class="h01">نـبـذة عـن الـحـسـابـات</h2>
        </div>
    </div>

    <div class="row flex-container">
        <div id="testimonial-slider" class="flexslider">
            <ul class="slides">
                <li>
                    <div class="testimonial-author">

                        <div class="author-info">
                            حساب الشركة
                            <span>الـصـفـحـة الـرئـيـسـيـة</span>
                            <span class="position"></span>
                        </div>
                    </div>

                    <img src="images/company_main_page.JPG" alt="إضغط لتكبير الصورة">
                </li> <!-- /slide -->

                <li>
                    <div class="testimonial-author">

                        <div class="author-info">
                            حساب التاجر
                            <span>الـصـفـحـة الـرئـيـسـيـة</span>
                        </div>
                    </div>

                    <img src="images/dealer_main_page.JPG" alt="إضغط لتكبير الصورة">

                </li> <!-- /slide -->
            </ul> <!-- /slides -->
        </div> <!-- /testimonial-slider -->
    </div> <!-- /flex-container -->
</section> <!-- /testimonials -->

<!-- cta
================================================== -->
<section id="cta">
    <div class="row cta-content">
        <div class="col-twelve">
        <!--
            <h1 class="h01">إذا كان لـديـك أي سـؤال أو إسـتـفـسـار لا تـتـردد بـمـراسـلـنـا عـلـى الإيـمـيـل أدنـاه</h1>
            <br>
            <p class="lead"><a href="mailto:Mail@foreasydeals.com">Mail@foreasydeals.com</a></p>
            -->

            <ul class="stores">
                <li class="app-store">
                    <a class="button round large" style="cursor: not-allowed; opacity: 0.5;" title="">
                        <i class="icon ion-social-apple" disabled></i>أبـل
                    </a>
                </li>
                <li class="play-store">
                    <a href="Apps/Easy Deals.apk" class="button round large" title="حمل التطبيق لنظام اندرويد">
                        <i class="icon ion-social-android"></i>أنـدرويـد</a>
                </li>
                <li class="windows-store" >
                    <a class="button round large" style="cursor: not-allowed; opacity: 0.5;" title="">
                        <i class="icon ion-social-windows" ></i>ويـنـدوز</a>
                </li>
            </ul>

        </div>
    </div> <!-- /cta-content -->
</section> <!-- /cta -->


<!-- footer
================================================== -->
<footer>
    <div class="footer-main">
        <div class="row">
            <div class="col-four tab-full mob-full footer-info">
                <div class="footer-logo"></div>
                <p>
                    فلسطين - الـضـفـة الغربية<br>
                    Mail@foreasydeals.com &nbsp; +123-456-789
                </p>

            </div> <!-- /footer-info -->

            <div class="col-two tab-1-3 mob-1-2 site-links">
                <h4>روابـط</h4>
                <ul>
                    <li><a href="#">من نحن</a></li>
                    <li><a href="#">المدونة</a></li>
                    <li><a href="#">أسئلة شائعة</a></li>
                    <li><a href="#">إبلاغ عن مشكلة</a></li>
                    <li><a href="Privacy_Policy.php">سياسة الخصوصية</a></li>
                </ul>
            </div> <!-- /site-links -->

            <div class="col-two tab-1-3 mob-1-2 social-links">
                <h4>تواصل معنا</h4>
                <ul>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Dribbble</a></li>
                    <li><a href="#">Google+</a></li>
                    <li><a href="#">Skype</a></li>
                </ul>
            </div> <!-- /social -->

            <div class="col-four tab-1-3 mob-full footer-subscribe">
                <h4>إشتراك</h4>

                <p>إشترك ليصلك كل جديد</p>

                <div class="subscribe-form">
                    <form id="mc-form" class="group">
                        <input type="email" value="" name="dEmail" class="email" id="mc-email" placeholder="أدخل ايميلك واضغط سجل">
                        <input type="submit" name="subscribe" >
                        <label for="mc-email" class="subscribe-message"></label>
                    </form>
                </div>
            </div> <!-- /subscribe -->
        </div> <!-- /row -->
    </div> <!-- /footer-main -->

    <div class="footer-bottom">
        <div class="row">
            <div class="col-twelve">
                <div class="copyright">
                    <span>© Copyright EasyDeals 2017.</span>
                </div>

                <div id="go-top" style="display: block;">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon ion-android-arrow-up"></i></a>
                </div>
            </div>
        </div> <!-- /footer-bottom -->
    </div>
</footer>

<!-- Java Script
================================================== -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

</body>
</html>