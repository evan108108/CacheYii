<?php
class EUpdateCacheMapBehavior extends CActiveRecordBehavior
{
  public $cacheExp = 0;
  public $modelName;

  public function afterSave($event)
  {
    $cacheMap = Yii::app()->cache->get('modelUpdateMap');
    if($cacheMap === false)
    {
      $cacheMap = array($this->modelName=>time());
    }
    else 
    {
      $cacheMap[$modelName] = time();
      Yii::app()->cache->set("$id", $cacheMap, $this->cacheExp);
    }

    return parent::afterSave($event);
  }
}
