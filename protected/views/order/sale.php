<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orders',
);

$this->menu=array(
        array('label'=>'Sale', 'url'=>array('sale')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orders',
);

$this->menu=array(
        array('label'=>'Sale', 'url'=>array('sale')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h1>Sale</h1>

<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sale-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
	<?php $this->widget('ext.tokeninput.TokenInput', array(
        'model' => $model,
        'attribute' => 'product_name',
        'url' => array('order/ajax'),
        'options' => array(
            'allowCreation' => true,
            'preventDuplicates' => true,
            'resultsFormatter' => 'js:function(item){ return "<li><p>" + item.name + "</p></li>" }',
            'theme' => 'facebook',
            'onAdd' => 'js:function(item){ $.ajax({
                    url: "index.php?r=order/addproduct",
                    data: { "term_id": item.id , "term_name": item.name , "term_qty": 1 },
                    success: function(data) { $("#order-grid").html(data);$(".token-input-token-facebook").remove(); }
                });
        }',
        )
        )); 
        ?>
	
	</div>
        
        <div id="order-grid" class="grid-view">
            
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php 
    
//    Yii::app()->clientScript->registerScript('car-js', $script);
?>        
</div><!-- form -->

