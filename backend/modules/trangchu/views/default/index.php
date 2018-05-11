<?php

    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
?>
<?php 
    if(isset($dataSubjects) && $dataSubjects){
        foreach ($dataSubjects as $key => $dataSubject) {
            $name = $dataSubject->NAME;

            $dataSubjectChilds = $dataSubject['child']
            // $link = 'chu-de/'.$dataSubject->ALIAS.$suffix;
 ?>
        <section class="homepage-category">
            <header class="panel-head uk-flex uk-flex-middle">
                <h2 class="heading"><a href="" title="Dự án nổi bật"><?= $name ?></a></h2>
            </header>
            <section class="panel-body">
                <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 list-product" data-uk-grid-match="{target:'.title'}">
                    <?php 
                        // for ($i=1; $i <=3 ; $i++) { 
                        foreach ($dataSubjectChilds as $key => $dataSubjectChild) {
                            
                            $idChild          = $dataSubjectChild['ID'];
                            
                            $nameChild        = $dataSubjectChild->NAME;
                            
                            $descriptionChild = $dataSubjectChild->DESCRIPTION;
                            
                            $aliasChild       = $dataSubjectChild->ALIAS;
                            
                            $imageChild       = $dataSubjectChild['IMAGE'];
                            
                            $linkImageChild   = 'uploads/subject/'.$idChild.'/image/'.$imageChild;
                            
                            $linkListQuestion = $baseUrl.'chu-de/'.$aliasChild .$suffix ;
                	 ?>
                    <li>
                        <div class="product">
                            <div class="thumb">
                                <a class="image img-cover img-shine" href="<?= $linkListQuestion ?>" title="<?= $descriptionChild ?>"><img src="<?= $linkImageChild ?>" alt="<?= $nameChild ?>"></a>
                                <span class="price"><strong>::</strong><i>Truy cập</i></span>
                            </div>
                            <div class="infor">
                                <h3 class="title" style="min-height: 44px;">
                                    <a href="<?= $linkListQuestion ?>" title="<?= $nameChild ?>"><?= $nameChild ?></a>
                                </h3>
                            </div>
        					
                        </div>
                    </li>
                    <?php } ?>
                                                    
                </ul>
            </section><!-- .panel-body -->
        </section><!-- .homepage-category -->
        <?php } ?>
<?php } ?>