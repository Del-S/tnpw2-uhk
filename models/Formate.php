<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Formate extends Model
{
    public $convertTable = array (
        'á' => 'a', 'Á' => 'A', 'ä' => 'a', 'Ä' => 'A', 'č' => 'c',
        'Č' => 'C', 'ď' => 'd', 'Ď' => 'D', 'é' => 'e', 'É' => 'E',
        'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'í' => 'i',
        'Í' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ľ' => 'l', 'Ľ' => 'L',
        'ĺ' => 'l', 'Ĺ' => 'L', 'ň' => 'n', 'Ň' => 'N', 'ń' => 'n',
        'Ń' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ö' => 'o', 'Ö' => 'O',
        'ř' => 'r', 'Ř' => 'R', 'ŕ' => 'r', 'Ŕ' => 'R', 'š' => 's',
        'Š' => 'S', 'ś' => 's', 'Ś' => 'S', 'ť' => 't', 'Ť' => 'T',
        'ú' => 'u', 'Ú' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ü' => 'u',
        'Ü' => 'U', 'ý' => 'y', 'Ý' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y',
        'ž' => 'z', 'Ž' => 'Z', 'ź' => 'z', 'Ź' => 'Z',
    );
    
    public function createGuid($source) {
        $source = strtolower(strtr($source, $this->convertTable));
        $source = preg_replace('/\s+/', ' ',$source);
        $source = str_replace(' ', '-',$source);
        $source = preg_replace('/[^A-Za-z\-]/', '', $source);     
        return $source;
    }
}
