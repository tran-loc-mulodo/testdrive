<?php

class OrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view' , 'sale' , 'ajax' , 'addproduct' , 'deleteproduct' , 'buy'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        public function actionAjax($q)
        {
            $term = trim($q);
            $result = array();

            if (!empty($term))
            {
                
                $cursor = Yii::app()->db->createCommand()
                ->select('*')
                ->from('tbl_product')
                ->where(array('like', 'product_name' , '%'.$term.'%'))        
                ->queryAll();
                
                if (!empty($cursor) ) //(!empty($cursor) && $cursor->count())
                {
                    foreach ($cursor as $id => $value)
                    {
                        $result[] = array('id' => $value['id'], 'name' => $value['product_name'] , 'price' => $value['price_sale']);
                    }
                }
            }
            
            header('Content-type: application/json');
            echo CJSON::encode($result);
            Yii::app()->end();
        }
        
        public function actionAddproduct() {
            if (!YII_DEBUG && !Yii::app()->request->isAjaxRequest) {
                throw new CHttpException('403', 'Forbidden access.');
            }
            if (empty($_GET['term_id'])) {
                throw new CHttpException('404', 'Missing "term" GET parameter.');
            }
            $product_before = Yii::app()->cache->get("test1153");
            $term_id = $_GET['term_id'];
            $term_name = $_GET['term_name'];
            $term_qty = $_GET['term_qty'];
            $term_price = $_GET['term_price'];
            $flg = FALSE;
            $model=new OrderDetail;
            $model->id = $term_id;
            $model->name = $term_name;
            $model->quality = $term_qty;
            $model->price = $term_price;
            if(!empty($product_before))
            {
                foreach ($product_before as $struct) {
                    if($struct->id == $term_id){
                        $struct->quality += $term_qty;
                        $struct->price *= $struct->quality;
                        $flg = TRUE;
                    }
                }
                if($flg){
                    $persons = $product_before;
                }else $persons = array_merge($product_before, array($model));;
                
            }  else {
                $persons = array($model);
            }
//            
            Yii::app()->cache->set("test1153", $persons, 60);
            $gridDataProvider = new CArrayDataProvider($persons);
            return $this->widget('bootstrap.widgets.TbGridView',array(
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
            
            Yii::app()->end();
        }
        
        public function actionDeleteproduct($id)
	{
		$product_before = Yii::app()->cache->get("test1153");
//                print_r($product_before);
                if(!empty($product_before))
                {
                    foreach ($product_before as $index => $struct) {
                        if($struct->id == $id){
                            unset($product_before[$index]);
                            
                        }
                    }
                }
//                print_r($struct);die;
		Yii::app()->cache->set("test1153", $product_before, 60);
            $gridDataProvider = new CArrayDataProvider($product_before);
            return $this->widget('bootstrap.widgets.TbGridView',array(
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
             
             Yii::app()->end();
	}
        
        public function actionBuy() {
            $data = Yii::app()->cache->get("test1153");
//            print_r($data);
            $order = new Order;
            $order->owner_id = 7;
            $order->save();
            $order_id = $order->primaryKey;
            
            //save data to order detail
            $order_detail = new OrderDetail;
            foreach ($data as $param_data) {
                $order_detail->setIsNewRecord(true);
                $order_detail->id = $param_data->id;
                $order_detail->name = $param_data->name;
                $order_detail->order_id = $order_id;
                $order_detail->price = $param_data->price;
                $order_detail->quality = $param_data->quality;
                $order_detail->save();
            }
            Yii::app()->cache->set("test1153", NULL);
            $this->redirect(array('sale'));
        }
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        /**
	 * Sale all models.
	 */
	public function actionSale()
	{
                $model=new Product;
                $this->performAjaxValidation($model);
                $this->render('sale',array(
			'model'=>$model,
		));
                
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
