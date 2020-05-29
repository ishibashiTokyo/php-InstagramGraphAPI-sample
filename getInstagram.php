<?php
$instagram_business_id = '';// InstagramビジネスアカウントのID
$access_token = '';// 有効期限無期限のアクセストークン
$post_count = 1;// 表示件数
$user_name = 'saku_fun';

// 自分のアカウント情報取得のサンプル
// $query = 'name,media.limit(' . $post_count. '){caption,like_count,media_url,permalink,timestamp,username,comments_count}';

// 別のInstagramビジネスアカウント記事取得のサンプル
// @doc     business_discovery  https://developers.facebook.com/docs/instagram-api/reference/user/business_discovery
//          media               https://developers.facebook.com/docs/instagram-api/reference/media
$query = 'business_discovery.username(' . $user_name . '){id,followers_count,media_count,ig_id,media.limit(' . $post_count. '){id,permalink,caption,media_url,media_type,like_count,comments_count,timestamp}}';

$get_url = 'https://graph.facebook.com/v7.0/' . $instagram_business_id . '?fields=' . $query . '&access_token=' . $access_token;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $get_url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

$instagram = null;
if($response) {
    $instagram = json_decode($response, true);
    if(isset($instagram->error)) {
        $instagram = null;
    }
}

print_r($instagram);