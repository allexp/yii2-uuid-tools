<?php
/**
 * Изначально разработано Сергеем Беляевым, доработано Nex Otaku.
 * Используется расширение "p2made/yii2-p2y2-things".
 */

namespace nex_otaku\uuid\helpers;

class uuid extends \p2made\helpers\Uuid
{
    public static function binUuid($subDomain = self::SUBDOMAIN_DEFAULT)
    {
        return pack("h*", str_replace('-', '', parent::uuid($subDomain)));
    }

    public static function uuid2bin($uuid)
    {
        if (is_null($uuid)) {
            return null;
        }
        return pack("h*", str_replace('-', '', $uuid));
    }

    public static function bin2uuid($bin)
    {
        if (is_null($bin)) {
            return null;
        }
        $uuid = unpack("h*", $bin);
        $uuid = preg_replace("/([0-9a-f]{8})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{12})/", "$1-$2-$3-$4-$5", $uuid);
        $uuid = array_merge($uuid);
        return $uuid[0];
    }

    public static function isUuid($uuid)
    {
        return preg_match("/([0-9a-f]{8})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{4})-([0-9a-f]{12})/", $uuid);
    }

    public static function isBinUuid($bin)
    {
        $uuid = self::bin2uuid($bin);
        return self::isUuid($uuid);
    }
}
