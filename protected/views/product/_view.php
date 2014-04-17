<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">
    <div class="imgWrap" >
        <?php
            echo CHtml::link(
            CHtml::image($data->getUrl() , CHtml::encode($data->product_name) , array()),
                    "images/products/".$data->img,
                    array('rel' => 'colorBox' , 'title' => CHtml::encode($data->product_name))
                    );
        ?>
    </div>
    <div class="caption">
        <?php echo CHtml::encode($data->product_name);?>
    </div>
	

</div>