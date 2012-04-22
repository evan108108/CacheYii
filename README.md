CacheYii
========

##Yii Extension that helps invalidate cache on Model dependent results
>####Will invalidate cache when any of the Models you have specified has been update since the cache was created

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
    ),
}
```

###Usage
>```
$model = EDCache::getCache("YOUR_UNIQUE_ID_HERE", array("Post", "Comments"));
if($model===false)
{
   $model = Post::model()->with('comments')->findAll();
   EDCache::setCache("YOUR_UNIQUE_ID_HERE", $model, 3600);
}
```

###Documentation
``` php
EDCache::getCache(YOUR_UNIQUE_ID, ARRAY_OF_MODEL_DEPENDENCIES);
EDCache::setCache(YOUR_UNIQUE_ID, DATA_TO_BE_CACHED, CACHE_EXPIRATION_IN_SECONDS);
```
