<?php
class EUpdateCacheMapBehavior extends CActiveRecordBehavior
{
  Const CACHE_MAP_NAME = 'modelUpdateMap';

  public $cacheExp = 0;
  public $modelName;

  public function afterSave($event)
  {
    $cacheMap = Yii::app()->cache->get(self::CACHE_MAP_NAME);
    if($cacheMap === false)
      $cacheMap = array();

    $cacheMap[$this->modelName] = time();
    
    Yii::app()->cache->set(self::CACHE_MAP_NAME, $cacheMap, $this->cacheExp);
    
    return parent::afterSave($event);
  }
}
