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

<h1>Orders</h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-index-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    
<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ 
$this->widget(
    'bootstrap.widgets.TbDatePicker',
    array(
        'name' => 'some_date_jap',
        
        'options' => array(
            'format' => 'dd/mm/yyyy',
            'language' => 'ja'
        )
    )
);

?>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Báo Cáo'); ?>
	</div>
<?php $this->endWidget(); ?>
    
<div id="order-grid" class="grid-view">
        <?php
            $data_array = Yii::app()->cache->get("test1153");
            
            
                
            
            $gridDataProvider = new CArrayDataProvider($dataProvider);
            
            $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'order-grid',
                'type'=>'striped bordered',
                'template' => "{items}",
                'dataProvider'=>$gridDataProvider,
                'columns' =>array(
                    array('name'=>'name', 'header'=>'Tên Sản Phẩm' ),
                    array(
                        'name'=>'quality',
                        'header'=>'Số Lượng',
                    ),
                     array('name'=>'price', 
                            'header'=>'Gia',
                            'footer'=>'Total Price',
                        'footerHtmlOptions'=>array('style'=>'font-weight: bold')
                            
                         ),
                    array('name'=>'paid', 'header'=>'Thành Tiền',
                            'class'=>'bootstrap.widgets.TbTotalSumColumn',
                            'footerHtmlOptions'=>array('style'=>'font-weight: bold')),
                ),
                ));
            
        ?>
        </div>
</div>