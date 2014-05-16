<?php

/**
 * This is the model class for table "tbl_order".
 *
 * The followings are the available columns in table 'tbl_order':
 * @property string $id
 * @property string $owner
 * @property string $saler
 * @property string $created_date
 * @property string $modified_date
 * @property integer $status
 * @property double $total_price
 * @property integer $total_goods
 * @property integer $discount
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_order';
	}

        protected function beforeSave() {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    $this->created_date = new CDbExpression("Now()");
                }else  $this->modified_date = new CDbExpression("Now()");
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
//			array('', 'required'),
			array(' status, total_goods, discount', 'numerical', 'integerOnly'=>true),
			array('total_price', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner, status, total_price, total_goods, discount', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner' => 'Owner',
                        'saler' => 'Saler',
			'created_date' => 'Created Date',
			'modified_date' => 'Modified Date',
			'status' => 'Status',
			'total_price' => 'Total Price',
			'total_goods' => 'Total Goods',
			'discount' => 'Discount',
		);
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('owner',$this->owner);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('total_goods',$this->total_goods);
		$criteria->compare('discount',$this->discount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
