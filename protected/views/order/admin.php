<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
        array('label'=>'Sale', 'url'=>array('sale')),
	array('label'=>'Create Order', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Orders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); 
?>
</div><!-- search-form -->

<?php // $this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'order-grid',
//	'dataProvider'=>$model->search(),
//	'filter'=>$model,
//	'columns'=>array(
//		'id',
//		'owner',
//		'created_date',
//		'modified_date',
//		'status',
//		'total_price',
//		/*
//		'discount',
//		*/
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//)); 
//$a = array(array('id' =>1 , 'owner' => 3 , 'status' => 1 ,'total_price' => 2 ),array('id' =>2 , 'owner' => '3' , 'status' => 0 ,'total_price' => 13 ));
//$gridDataProvider = new CArrayDataProvider($a);
$this->widget(
    'bootstrap.widgets.TbExtendedGridView',
    array(
        'fixedHeader' => true,
        'headerOffset' => 40,
        // 40px is the height of the main navigation at bootstrap
        'type' => 'striped',
        'dataProvider' => $model->search(),
        'responsiveTable' => true,
        'template' => "{items}",
        'columns' => array(
		'id',
		'owner',
		'status',
		'total_price',
		/*
		'discount',
		*/
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
    )
);
?>
