<?php

namespace Jerome\Blog\App;

abstract class MemoryCache {

    public static function fetch(string $key, int $ttl = 0, callable $value_producer = null) {
        $value = apcu_fetch($key);
        if($value === false) apcu_store($key, $value = $value_producer(), $ttl);
        return $value;
    }

}