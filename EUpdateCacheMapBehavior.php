<?php
class EUpdateCacheMapBehavior extends CActiveRecordBehavior
{
  public $cacheExp = 0;
  public $modelName;

  public function afterSave($event)
  {
    $cacheMap = Yii::app()->cache->get('modelUpdateMap');
    if($cacheMap === false)
      $cacheMap = array();

    $cacheMap[$this->modelName] = time();
    
    Yii::app()->cache->set('modelUpdateMap', $cacheMap, $this->cacheExp);
    
    return parent::afterSave($event);
  }
}
