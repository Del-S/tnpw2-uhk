<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Category;
use app\models\Formate;

class CategoryForm extends Model
{
    public $category_name;
    public $category_title = '';
    public $category_parent = 0;
    public $guid;
    public $menu_order = 0;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['category_name'], 'required'],
        ];
    }

    public function createCategory()
    {
        if ($this->validate()) {
            if(!isset($this->guid) && $this->guid == '') { $this->guid = $this->category_name; }
            $formate = new Formate();
            $this->guid = $formate->createGuid($this->guid);
            
            $attributes = $this::getAttributes();
            $category = new Category();
            $category->saveCategory($attributes);
        
        } else {
            return false;
        }
    }
}
