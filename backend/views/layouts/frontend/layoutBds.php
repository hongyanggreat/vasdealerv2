<?php
    // include('includes/head.php') ;
    use backend\widgets\frontend\HeadWidget;
    echo HeadWidget::widget();
?>
<body>

<header class="pc-header uk-visible-large">
    <?php
        // include('includes/header/topbar.php')
        use backend\widgets\frontend\TopBarWidget;
        echo TopBarWidget::widget();
    ?>
    <?php
        // include('includes/header/top-logo.php') ;
        use backend\widgets\frontend\TopLogoWidget;
        echo TopLogoWidget::widget();
    ?>
    <?php
        // include('includes/desktop/menu.php') ;
        use backend\widgets\frontend\MenuWidget;
        echo MenuWidget::widget();
    ?>
</header><!-- .header -->
<!-- MOBILE HEADER -->
<header class="mobile-header uk-hidden-large">
    <?php
        // include('includes/mobiles/top-header.php');
        use backend\widgets\frontend\TopHeaderMWidget;
        echo TopHeaderMWidget::widget();
    ?>
    <?php
        // include('includes/mobiles/search.php');
        use backend\widgets\frontend\SearchMWidget;
        echo SearchMWidget::widget();
    ?>
</header><!-- .mobile-header -->

<section id="body">
    <div id="product-page" class="page-body">
        <!-- <div class="breadcrumb">
            <div class="uk-container uk-container-center">
                <ul class="uk-breadcrumb">
                    <li><a href="http://datxanhbamien.vn/" title="Trang chủ"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li><a href="du-an-bds" title="Trang chủ">Dự án BĐS</a></li>
                    <li class="uk-active"><a href="du-an-bds/du-an-roman-plaza-hai-phat/62.html" title="Nội thất phòng bếp">Dự Án Roman Plaza - Hải Phát</a></li>
                </ul>
            </div>
        </div> -->
        <!-- .breadcrumb -->
        <div class="uk-container uk-container-center">
                <?php
                    $detailDuAnBds = [];
                    if(isset($this->params['detailDuAnBds']) && $this->params['detailDuAnBds']){
                         $detailDuAnBds = $this->params['detailDuAnBds'];

                    }
                    use backend\widgets\frontend\DetailDuAnBdsWidget;
                    echo DetailDuAnBdsWidget::widget(['data'=>$detailDuAnBds]);
                ?>

            <div class="uk-sticky-placeholder" style="height: 42px; margin: 0px;">

            </div><!-- .lower -->

            <div class="uk-grid lib-grid-20">
                <div class="uk-width-large-3-4">
                    <?= $content ?>
                </div>
                    
                <div class="uk-width-large-1-4 uk-visible-large">

                    <aside class="aside" style="margin-top: 40px;">
                        <?php
                            use backend\widgets\frontend\TracNghiemMoiWidget;
                            echo TracNghiemMoiWidget::widget();
                        ?>
                    </aside>
                </div>          
            </div><!-- .uk-grid -->

        <!-- //san pha lien quan -->
        <!-- //san pha lien quan -->
    </div>
        
</div>

</section><!-- #body -->
  
<?php
    use backend\widgets\frontend\TuVanWidget;
    echo TuVanWidget::widget();
?>
<?php
    use backend\widgets\frontend\FooterWidget;
    echo FooterWidget::widget();
?>
<!-- Mobile Hotline -->
<?php
    use backend\widgets\frontend\HotLineMWidget;
    echo HotLineMWidget::widget();
?>

<?php
    use backend\widgets\frontend\MenuMWidget;
    echo MenuMWidget::widget();
?>
<?php
    use backend\widgets\frontend\FootWidget;
    echo FootWidget::widget();
?>
