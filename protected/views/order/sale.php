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
        'action' => Yii::app()->createAbsoluteUrl('/order/buy'),
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
                    data: { "term_id": item.id , "term_name": item.name  , "term_qty": 1 , "term_price": item.price },
                    success: function(data) { $("#order-grid").html(data);$(".token-input-token-facebook").remove(); }
                });
        }',
        )
        )); 
        ?>
	
	</div>
        
        <div id="order-grid" class="grid-view">
        <?php
            $data_array = Yii::app()->cache->get("test1153");
            
            if(!empty($data_array))
            {
                
            
            $gridDataProvider = new CArrayDataProvider($data_array);
            
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
                        'footer'=>'Total Price',
                        'footerHtmlOptions'=>array('style'=>'font-weight: bold')
                    ),
                     array('name'=>'price', 
                            'header'=>'Gia',
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
//                        'viewButtonUrl'=>'',
//                        'updateButtonUrl'=>null,
//                        'deleteButtonUrl'=>null,
                        'deleteConfirmation'=>'Está seguro que desea terminar la sesión seleccionada?',
                        'deleteButtonUrl'=>'Yii::app()->createUrl("order/deleteproduct", array("id"=>$data->id))',
                    ),
                ),
                ));
            }
        ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<?php 
    
//    Yii::app()->clientScript->registerScript('car-js', $script);
?>        
</div><!-- form -->
<script>

jQuery(document).on('click','#order-grid a.delete',function() {
    if(!confirm('Are you sure you want to delete this item?')) return false;
    
    $.ajax({
        url: jQuery(this).attr('href'),
        type: "GET",
        //data: { id : menuId },
        dataType: "html",
        success : function (data) {
            $("#order-grid").html(data);
        }
        });
    return false;
}); 
    </script>
