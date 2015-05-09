<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\db\CategoryMeta;
use app\models\Formate;

class CategoryMetaForm extends Model
{
    public $meta_id;
    public $post_id;
    public $category_id;
    public $meta_key;
    public $meta_value;
    public $meta_value_old;

    public function __construct( $data = [], $config = [] ) {
        foreach($data as $k => $v) {
            if($this->hasProperty($k)) {
                $this->$k = $v;
            }
        }
        if(array_key_exists('meta_value', $data)) {
            $this->meta_value_old = $data['meta_value'];
        } else { $this->meta_value_old = []; }
        
        parent::__construct();
    }
    
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'meta_value' => 'Kategorie',
        ];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['post_id' ], 'default', 'value' => '0'],
            [['meta_key', 'meta_value' ], 'default', 'value' => ''],
        ];
    }

    public function saveCategoryMeta()
    {
        if ($this->validate()) { 
            if(is_array($this->meta_value)) {            
                /* add post ids to category */
                foreach($this->meta_value as $key => $form_category_id) {
                    $meta = CategoryMeta::find()->where(['category_id' => $form_category_id, 'meta_key' => $this->meta_key])->one();
                    
                    if(is_object($meta)) {
                        $current_val = $meta->meta_value;
                        if(strpos($current_val, '"'.$this->post_id.'"') === false) { $current_val .= '"'.$this->post_id.'";'; }
                        $meta->meta_value = $current_val;
                        $meta->save();
                    } else {
                        $meta = new CategoryMeta();
                        $meta->category_id = $form_category_id;
                        $meta->meta_key = $this->meta_key;
                        $meta->meta_value = '"'.$this->post_id.'";';
                        $meta->save();
                    }
                }
            } else { $this->meta_value = array(); }
            
            /* remove post ids from category */
            $meta_intersect = array_intersect($this->meta_value_old, $this->meta_value);
            if($this->meta_value_old != $meta_intersect) {
                $remove = array_diff($this->meta_value_old, $meta_intersect);
                foreach($remove as $key => $form_category_id) {
                    $meta = CategoryMeta::find()->where(['category_id' => $form_category_id, 'meta_key' => $this->meta_key])->one();
                    
                    if(is_object($meta)) {
                        $meta->meta_value = str_replace('"'.$this->post_id.'";', '', $meta->meta_value);
                        $meta->save();
                    }
                }
            }
            
            return true;
        } else {
            return false;
        }
    }
}
