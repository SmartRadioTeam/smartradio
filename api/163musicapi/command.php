<?php
function curl_get($music_id)
{
    $refer = "http://music.163.com/";
    $header[] = "Cookie: appver=1.9.2.109452;";
    $ch = curl_init();
    $url = "http://music.163.com/api/song/detail/?id=" . $music_id . "&ids=%5B" . $music_id . "%5D";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
function get_music_info($music_id)
{
    //添加python方法
    return curl_get($music_id);
} 