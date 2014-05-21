<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	"Đặt Hàng",
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
        array('label'=>'Sale', 'url'=>array('sale')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h1>Đặt Hàng</h1>

<?php 
$product_before = Yii::app()->cache->get("test1153");
$gridDataProvider = new CArrayDataProvider($product_before);
$this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'order-grid',
                'type'=>'striped bordered',
                'template' => "{items}",
                'dataProvider'=>$gridDataProvider,
                'columns' =>array(
                    array('name'=>'name', 'header'=>'Name' ),
                    array(
                        'name'=>'quality',
                        'header'=>'So luong',
                    ),
                     array('name'=>'price', 
                            'header'=>'Giá',
                            'footer'=>'Total Price',
                            'footerHtmlOptions'=>array('style'=>'font-weight: bold')
                            
                         ),
                    array('name'=>'paid',
                            'header'=>'Thành Tiền',
                            'class'=>'bootstrap.widgets.TbTotalSumColumn',
                            'footerHtmlOptions'=>array('style'=>'font-weight: bold')
                            
                         ),
                    array(
                        'htmlOptions' => array('nowrap'=>'nowrap'),
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{delete}',
                        'buttons'=>array(            
                            'delete' => array(
                              'label'=>'Terminar sesión',
                            ),
                          ),
                        'deleteConfirmation'=>'Está seguro que desea terminar la sesión seleccionada?',
                        'deleteButtonUrl'=>'Yii::app()->createUrl("order/deleteproduct", array("id"=>$data->id))',
                    ),
                ),
                ));
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schedule-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner'); ?>
               
		<?php echo $form->error($model,'owner'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price'); ?>
		<?php echo $form->error($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deposit'); ?>
		<?php echo $form->textField($model,'deposit'); ?>
		<?php echo $form->error($model,'deposit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
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
<?php
        /** @var TbActiveForm $form */
    $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'horizontalForm',
        'type' => 'horizontal',
    )
    );
    //echo $form->textFieldRow($model, 'owner', array('hint'=>'In addition to freeform text, any HTML5 text-based input appears like so.'));
//    echo $form->textFieldGroup($model, 'textField');
    ?>

<fieldset>
 
    <legend>Legend</legend>
 
    <?php echo $form->textFieldRow($model, 'owner', array('hint'=>'In addition to freeform text, any HTML5 text-based input appears like so.')); ?>
    	<?php /*echo $form->DatePicker(
$model,
'date_receive',
array(
'widgetOptions' => array(
'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'
),
'wrapperHtmlOptions' => array(
'class' => 'col-sm-5',
),
'hint' => 'Click inside! An even a date range field!.',
'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
)
);*/ 
echo '<span class="input-group-addon">
<i class="glyphicon glyphicon-calendar"></i>
</span>'.$form->datepickerRow($model, 'date_receive');
?>
    <?php //echo $form->dropDownListRow($model, 'dropdown', array('Something ...', '1', '2', '3', '4', '5')); ?>
    <?php //echo $form->dropDownListRow($model, 'multiDropdown', array('1', '2', '3', '4', '5'), array('multiple'=>true)); ?>
    <?php //echo $form->fileFieldRow($model, 'fileField'); ?>
    <?php //echo $form->textAreaRow($model, 'textarea', array('class'=>'span8', 'rows'=>5)); ?>
    <?php //echo $form->uneditableRow($model, 'uneditable'); ?>
    <?php //echo $form->textFieldRow($model, 'disabled', array('disabled'=>true)); ?>
    <?php //echo $form->textFieldRow($model, 'prepend', array('prepend'=>'@')); ?>
    <?php //echo $form->textFieldRow($model, 'append', array('append'=>'.00')); ?>
    <?php //echo $form->checkBoxRow($model, 'disabledCheckbox', array('disabled'=>true)); ?>
    <?php //echo $form->checkBoxListInlineRow($model, 'inlineCheckboxes', array('1', '2', '3')); ?>
    <?php /*echo $form->checkBoxListRow($model, 'checkboxes', array(
        'Option one is this and that—be sure to include why it\'s great',
        'Option two can also be checked and included in form results',
        'Option three can—yes, you guessed it—also be checked and included in form results',
    ), array('hint'=>'<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>
    <?php echo $form->radioButtonRow($model, 'radioButton');*/ ?>
    <?php /*echo $form->radioButtonListRow($model, 'radioButtons', array(
        'Option one is this and that—be sure to include why it\'s great',
        'Option two can is something else and selecting it will deselect option one',
    ));*/ ?>
 
</fieldset>
 
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>
 
<?php $this->endWidget(); ?>

<div class="btn-toolbar">
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'Action', 'url'=>'#'),
            array('items'=>array(
                array('label'=>'Action', 'url'=>'#'),
                array('label'=>'Another action', 'url'=>'#'),
                array('label'=>'Something else', 'url'=>'#'),
                '---',
                array('label'=>'Separate link', 'url'=>'#'),
            )),
        ),
    )); ?>
</div>