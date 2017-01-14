<?php
/**
 * Created by IntelliJ IDEA.
 * Jg: 201
 * Date: 2017/1/7
 * Time: 18:39
 */

namespace lib\common;


class Tool
{
    public static function setKf($farr, $fk, $fname, $arr, $k, $name)
    {
        foreach ($farr as $key => $val) {
            $farr[$val[$fk]] = $val[$fname];
        }
        foreach ($arr as $key => $val) {
            if (isset($farr[$val[$k]])) {
                $arr[$key][$name] = $farr[$val[$k]];
            } else {
                $arr[$key][$name] = '';
            }
        }
        return $arr;
    }

}