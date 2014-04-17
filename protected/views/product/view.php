<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Update Product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>
<?php
//Widht of the barcode image. 
$width  = 284;  
//Height of the barcode image.
$height = 184;
//Quality of the barcode image. Only for JPEG.
$quality = 100;
//1 if text should appear below the barcode. Otherwise 0.
$text =1;
// Location of barcode image storage.
$location = Yii::getPathOfAlias("webroot").'/images/barcode/bc.jpg';
 
Yii::import("application.extensions.barcode.*");                      
barcode::Barcode39('some text', $width , $height , $quality, $text, $location);
 ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_name',
		'img',
		'price_sale',
		'barcode',
		'status',
		'category_id',
	),
)); ?>
