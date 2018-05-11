<?php 
	use yii\helpers\Html;
	$baseUrl = Yii::$app->params['baseUrl'];
	$suffix = Yii::$app->params['suffix'];
	$module = Yii::$app->controller->module->id;
		$template = '';
		$arrActions = Yii::$app->acl->getRole();
		if(in_array('view', $arrActions)){
			if($dataProvider['task'] == "ButtonControl2"){
				$linkView = $baseUrl.$module.'/view'.$suffix.'?id='.$dataProvider['ID'];
				if(isset($dataProvider['URL_VIEW'])){
					$linkView = $dataProvider['URL_VIEW'];
				}
				$template .= Html::a('<i class="icon icon-eye-open"></i>', $linkView, [
                                              'title' => Yii::t('app', 'Xem'),
                                              'class' => 'marginAction',
                                              'style' => 'margin-left:5px;',
                                  ]);
			}else{

				$template .= '{view}';
			}
		}
		if(in_array('update', $arrActions)){
			$linkUpdate = $baseUrl.$module.'/update'.$suffix.'?id='.$dataProvider['ID'];
			if(isset($dataProvider['URL_UPDATE'])){
				$linkUpdate = $dataProvider['URL_UPDATE'];
			}
			if($dataProvider['task'] == "ButtonControl2"){
				if($linkUpdate){
					$template .= Html::a('<i class="icon icon-edit"></i>', $linkUpdate, [
	                                              'title' => Yii::t('app', 'Sửa'),
	                                              'class' => 'marginAction',
	                                              'style' => 'margin-left:5px;',
	                                  ]);
				}
			}else{

				$template .= '{update}';
			}
		}
		if(in_array('delete', $arrActions)){
			$linkDelete = $baseUrl.$module.'/delete'.$suffix.'?id='.$dataProvider['ID'];

			if(isset($dataProvider['URL_DELETE'])){
				$linkDelete = $dataProvider['URL_DELETE'];
			}
			if($dataProvider['task'] == "ButtonControl2"){
				if($linkDelete){
					$template .=  Html::a(' <i class="icon icon-trash"></i>', null, [
                              'data' => [
								'confirm' => 'Bạn có chắc muốn thoát?',
								'method'  => 'post',
								'value'   =>$dataProvider['ID'],
                              ],
                              'action'.$dataProvider['ID'] => $linkDelete,
                              'href'=>"javascript:void(0);",
                              'title'=>"Xóa bản ghi",
                              'onclick'=>'deleteRecord('.$dataProvider['ID'].')',
                           ]);
					/*$template .= Html::a('<i class="icon icon-trash"></i>', $linkDelete, [
	                                              'title' => Yii::t('app', 'Xóa'),
	                                              'class' => 'marginAction',
	                                              'style' => 'margin-left:5px;',
	                                  ]);*/
				}
			}else{

				$template .= '{delete}';
			}
		}
		
		echo $template;
 ?>

  <script>
    function deleteRecord(input) {
      var result = confirm("Bạn có chắc muốn xóa?");
      var linkDel = '<?php echo $linkDelete = $baseUrl.$module.'/delete'.$suffix.'?id=' ?>'+input;
      if (result) {
      		var x = document.getElementById("formRecord");
      		x.action = linkDel;
            x.submit();
      }
    }
  </script>