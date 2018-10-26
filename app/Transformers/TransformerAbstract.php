<?php 
namespace App\Transformers;

abstract class TransformerAbstract{
    public function transformCollection(array $data_items){
        return array_map([$this, 'transform'], $data_items);
    }
    public abstract function transform($data_item);

}

?>