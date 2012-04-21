<?php
  class EDCache extends CApplicationComponent
  {
    public static function getCache($id, $dependencies=array())
    {
      if(!is_array($dependencies))
        $dependencies = array($dependencies);

      $modelUpdateMap = Yii::app()->cache->get('modelUpdateMap');
      if($modelUpdateMap === false)
        $modelUpdateMap = array();

      $cacheCrtDtm = Yii::app()->cache->get($id . "_crtdtm");
      if($cacheCrtDtm === false)
        return false;

      foreach($dependencies as $dependency)
      {
        if(isset($modelUpdateMap[$dependency]) && $modelUpdateMap[$dependency] > $cacheCrtDtm)
          return false;
      }

      $cacheResult = Yii::app()->cache->get($id);
      if($cacheResult === false)
        return false;

      return $cacheResult;
    }

    public static function setCache($id, $dataToCache, $exp)
    {
      Yii::app()->cache->set("$id", $dataToCache, $exp);
      Yii::app()->cache->set($id . "_crtdtm", time(), $exp);
      return true;
    }
  }
