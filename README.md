CacheYii
========

##Yii Extension that helps invalidate cache on Model dependent results
>####Invalidates cache when any of the Model dependencies you have specified have been updated since the cache was created

###Installation
>1. git clone git@github.com:evan108108/CacheYii.git
>2. Place CacheYii in your 'protected/extensions' directory
>3. In your protected/config/main.php

>```
'import'=>array(
    ...
    'ext.CacheYii.*',
),
```
>4. Add this behavor to any model you intend to use as a cache dependency 

>```
 function behaviors() {
    'updateCacheMapBehavior' => array(
        'class'=>'ext.CacheYii.EUpdateCacheMapBehavior',
        'cacheExp'=>0, //This is optional and the default is 0 (0 means never expire)
        'modelName'=>__CLASS__,
        'modelUpdateMap'=>Yii::app()->cache->get('modelUpdateMap'),
    ),
}
```

###Usage
>```
$model = EDCache::get("YOUR_UNIQUE_ID_HERE", array("Post", "Comments"));
if($model===false)
{
   $model = Post::model()->with('comments')->findAll();
   EDCache::set("YOUR_UNIQUE_ID_HERE", $model, 3600);
}
```

>```
EDCache::delete("YOUR_UNIQUE_ID_HERE");
```

###Documentation
``` php
EDCache::get(YOUR_UNIQUE_ID, ARRAY_OF_MODEL_DEPENDENCIES);
EDCache::set(YOUR_UNIQUE_ID, DATA_TO_BE_CACHED, CACHE_EXPIRATION_IN_SECONDS);
```
