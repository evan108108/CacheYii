<?php
class EUpdateCacheMapBehavior extends CActiveRecordBehavior
{
  Const CACHE_MAP_NAME = 'modelUpdateMap';

  public $cacheExp = 0;
  public $modelName;
  public $modelUpdateMap = false;

  public function afterSave($event)
  {
    $this->updateModelUpdateMap();
    return parent::afterSave($event);
  }

  public function afterDelete($event)
  {
    $this->updateModelUpdateMap();
    return parent::afterDelete($event);
  }

  private function updateModelUpdateMap()
  {
    if($this->modelUpdateMap === false)
      $this->modelUpdateMap = array();

    $this->modelUpdateMap = CMap::mergeArray($this->modelUpdateMap, array($this->modelName=>time()));
    
    Yii::app()->cache->set(self::CACHE_MAP_NAME, $this->modelUpdateMap, $this->cacheExp);
  }
}
