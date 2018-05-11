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
    
    <?php //include('includes/blocks/main-slide.php') ?>
    <?php
        // use backend\widgets\frontend\MainSlideWidget;
        // echo MainSlideWidget::widget();
    ?>

    <div id="product-page" class="page-body">
        <div class="uk-container uk-container-center">
            <div class="uk-grid ">
                <div class="uk-width-large-4-4">
                    <?= $content ?>
                    <?php //include('includes/blocks/du-an-noi-bat.php'); ?>
                    <?php //include('includes/blocks/du-an-bds.php'); ?>
                </div>
                
            <?php //include('includes/blocks/su-kien-mo-ban.php'); ?>
            <?php
                // use backend\widgets\frontend\SuKienMoBanWidget;
                // echo SuKienMoBanWidget::widget();
            ?>
            <?php //include('includes/blocks/tin-tuc-bds.php'); ?>
            <?php
                // use backend\widgets\frontend\TinTucBdsWidget;
                // echo TinTucBdsWidget::widget();
            ?>
            <?php //include('includes/blocks/doi-tac.php'); ?>
        </div><!-- .uk-container -->
    </div><!-- .page-body -->   
</section><!-- #body -->
<?php //include('includes/tuvan.php'); ?>
<?php
    use backend\widgets\frontend\TuVanWidget;
    echo TuVanWidget::widget();
?>
<?php //include('includes/footer.php'); ?>
<?php
    use backend\widgets\frontend\FooterWidget;
    echo FooterWidget::widget();
?>
<?php //include('includes/mobiles/hot-line.php'); ?>
<?php
    use backend\widgets\frontend\HotLineMWidget;
    echo HotLineMWidget::widget();
?>
<?php //include('includes/mobiles/menu.php'); ?>
<?php
    use backend\widgets\frontend\MenuMWidget;
    echo MenuMWidget::widget();
?>
<?php //include('includes/foot.php'); ?>
<?php
    use backend\widgets\frontend\FootWidget;
    echo FootWidget::widget();
?>

