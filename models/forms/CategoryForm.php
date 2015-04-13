<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\db\Category;
use app\models\Formate;

class CategoryForm extends Model
{
    public $category_name;
    public $category_title;
    public $guid;
    public $category_parent;
    public $menu_order;
    public $errors;

    public function __construct( $data = [], $config = [] ) {    
        foreach($data as $k => $v) {
            if($this->hasProperty($k)) {
                $this->$k = $v;
            }
        }   
        parent::__construct();
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_title', 'category_parent', 'guid', 'menu_order' ], 'default'],
        ];
    }
    
    public function createCategory()
    {
        if ($this->validate()) {
            if(!isset($this->guid) || $this->guid == '') { $this->guid = $this->category_name; }
            $formate = new Formate();
            $this->guid = $formate->createGuid($this->guid);
        
            $category = new Category();
            $attributes = $this::getAttributes();
            $category->saveCategory($attributes);
            
            if($category->hasErrors()) { 
                $this->errors = $category->getErrors();
                return false;  
            }
            return true;   
        } else {
            return false;
        }
    }
    
    public function updateCategory($category)
    {
        if ($this->validate()) {
            if(!isset($this->guid) || $this->guid == '') { $this->guid = $this->category_name; }
            $formate = new Formate();
            $this->guid = $formate->createGuid($this->guid);
        
            $attributes = $this::getAttributes();
            $category->isNewrecord = false;
            $category->saveCategory($attributes);
            
            if($category->hasErrors()) { 
                $this->errors = $category->getErrors();
                return false;  
            }
            return true;   
        } else {
            return false;
        }
    }
}
