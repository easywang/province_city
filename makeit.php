<?php
/**
 * 数据来自于：中国邮政集团公司
 */
main();
function main()
{
    file_put_contents('cities.xls', "code,name,parentid, level");
    makeOne(0, 0);
}
global $x;
function makeOne($id, $level)
{
    $level++;
    $data = get_children($id);
    $data = json_decode($data);

    foreach ($data as $value) {
        $code     = $value->region_id;
        $name     = iconv($value->region_name, 'utf-8', 'gbk');
        $parentid = $id;
        save_data($code, $name, $parentid, $level);
        echo "\r\n $code, $name";
    }

    if ($level <= 2) {
        foreach ($data as $value) {
            $code = $value->region_id;
            echo "\r\n===========child: " . $value->region_name;
            makeOne($code, $level);
        }
    }

}
function save_data($code, $name, $parentid, $level)
{
    file_put_contents('cities.xls', "\r\n$code,$name,$parentid,$level", FILE_APPEND);
    //todo save to sql
    //todo save to json
}
function get_all_province()
{
    return get_children(0);
}

function get_cities($id)
{
    return get_children($id);
}

function get_area($id)
{
    return get_children($id);
}

function get_children($id)
{
    $url = "http://www.cpdc.com.cn/web/api.php?op=get_linkage&act=ajax_select&keyid=1&parent_id=" . $id;
    return file_get_contents($url);

}
