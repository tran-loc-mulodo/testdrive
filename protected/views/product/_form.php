<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
        'htmlOptions'=>array(
            'enctype' => 'multipart/form-data',
        ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>
    

    <?php
        foreach (Yii::app()->user->getFlashes() as $type => $flash)
        {
            echo "<div class='{$type}'>{$flash}</div>";
        }
    ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model , 'category_id' , $model->getCategoryOptions()) ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img'); ?>
		<?php //echo $form->textField($model,'img',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo CHtml::activeFileField($model, 'img'); ?>
                <!--<img src="images/products/<?php //echo $model->img; ?>" />-->
                <?php if(!empty($model->img)){ ?>
                <div class="imgWrap" >
                    <?php
                        echo CHtml::image($model->getUrl() , CHtml::encode($model->product_name) , array());
                    ?>
                </div>
                <?php } ?>
                <!--<?php echo $form->error($model,'img'); ?>-->
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_sale'); ?>
		<?php echo $form->textField($model,'price_sale'); ?>
		<?php echo $form->error($model,'price_sale'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'barcode'); ?>
		<?php echo $form->textField($model,'barcode',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'barcode'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description' , array('cols' => '60' , 'height' => '12')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        
        <?php /*$this->widget('application.extensions.tinymce.ETinyMce',
                array(
                    'name'=>'Product[description]',
                    'value' => $model->description,
                    'useSwitch' => false,
                    'editorTemplate'=>'full'
                    )
                );*/  ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'package_id'); ?>
                <?php //print_r($model); ?>
		<?php echo $form->dropDownList($model , 'package_id' , $model->getPackageOptions()) ?>
		<?php echo $form->error($model,'package_id'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'initials'); ?>
		<?php echo $form->textField($model,'initials',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'initials'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->