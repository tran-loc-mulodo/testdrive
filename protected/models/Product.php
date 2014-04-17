<?php

/**
 * This is the model class for table "tbl_product".
 *
 * The followings are the available columns in table 'tbl_product':
 * @property integer $id
 * @property string $product_name
 * @property string $img
 * @property double $price_sale
 * @property string $barcode
 * @property integer $status
 * @property integer $category_id
 * @property string $description
 * @property string $created_dt
 * @property integer $package_id
 * @property integer $initials
 * @property integer $owner_id
 */
class Product extends CActiveRecord
{
    private $_img;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_product';
	}
        
        protected function beforeSave() {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    $this->created_dt = new CDbExpression("Now()");
                    $this->owner_id = Yii::app()->user->id;
                }
                return true;
            }else
                return false;
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, price_sale, status', 'required'),
			array('status, category_id , package_id , initials , owner_id', 'numerical', 'integerOnly'=>true),
			array('price_sale', 'numerical'),
			array('product_name, img', 'length', 'max'=>255),
			array('barcode', 'length', 'max'=>50),
                        array('description', 'length', 'max'=>1024),
                        array('description', 'match', 'pattern'=>'/[\w]+/u'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_name, img, price_sale, barcode, status, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

        public function scopes() {
            return array(
                'shareable' => array(
                    'order' => 'created_dt DESC',
                    'condition' => 'status = 1'
                )
            );
        }

                /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_name' => 'Product Name',
			'img' => 'Img',
			'price_sale' => 'Price Sale',
			'barcode' => 'Barcode',
			'status' => 'Status',
			'category_id' => 'Category',
                        'description' => 'Description',
                        'created_id'  => 'Create date',
                        'package_id'  => 'Package',
                        'initials'    => 'Initial',  
                        'owner_id'    => 'Owner',
		);
	}
        
        public function getImageParam()
        {
            if(empty($this->_img))
                $this->_img = Yii::app ()->params['uploads']."/";
            return $this->_img;
        }
        
        public function getUrl()
        {
            return $this->getImageParam().CHtml::encode($this->img);
        }

        public function getCategoryOptions()
        {
            $cats = Category::model()->findAll();
            $data = array(null => "Select Parent Category");
            foreach ($cats as $model)
            {
                $data[$model->id] = $model->title;
            }
            return $data;
        }
        
        public function getPackageOptions()
        {
            $packs = Package::model()->findAll();
            $data = array(null => "Select Parent Package");
            foreach ($packs as $model)
            {
                $data[$model->id] = $model->name;
            }
            return $data;
        }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('price_sale',$this->price_sale);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('description',$this->description);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
