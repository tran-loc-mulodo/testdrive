<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<?php
    $colorBox = $this->widget('application.extensions.colorpowered.JColorBox');
?>

<h1>Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php $colorBox->addInstance("a[rel=\'colorBox\']" , array('maxHeight' => '90%' , 'maxWidth' => '90%')); ?>

<?php 
 Yii::app()->clientScript->registerScript('caption' , "jQuery('.imgWrap').hover(
         function(){
                if($(this).next().html().trim()!== '')
                $(this).next().slideDown();
            },
            function(){
                $(this).next().hide();
            }
            );"
         ,  CClientScript::POS_READY);
?>