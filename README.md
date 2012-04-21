CacheYii
========

##Helps invalidate cache on Model dependent results

###Installation
>1. git clone git@github.com:evan108108/CacheYii.git
>2. Place CacheYii in your 'protected/extensions' directory
>3. In your protected/config/main.php
>```php
'import'=>array(
    ...
    'ext.CacheYii.*',
),
```
>4. Add this behavor to any model you intend to use as a cache dependency 
>```php
 function behaviors() {
  'updateCacheMapBehavior' => array(
    'class'=>'ext.CacheYii.EUpdateCacheMapBehavior',
    'cacheExp'=>3600,
    'modelName'=>__CLASS__,
  ),
}
```

###Usage
>```php
$model = EDCache::getCache("YOUR_UNIQUE_ID_HERE", array("Post", "Comments"));
if($model===false)
{
   $model = Post::model()->with('comments')->findAll();
   EDCache::setCache("YOUR_UNIQUE_ID_HERE", $model, 3600);
}
```

###Documentation
>EDCache::getCache(YOUR_UNIQUE_ID, ARRAY_OF_MODEL_DEPENDENCIES)
>EDCache::setCache(YOUR_UNIQUE_ID, DATA_TO_BE_CACHED, CACHE_EXPIRATION_IN_SECONDS);
