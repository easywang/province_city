<?php

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
    return $url_get = "http://www.cpdc.com.cn/web/api.php?op=get_linkage&act=ajax_select&keyid=1&parent_id=" . $id;

}
