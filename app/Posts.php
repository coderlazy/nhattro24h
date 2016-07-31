<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {

    protected $table = 'posts';
    public static function insertPost($message) {
        if (strlen($message) > 0) {
            $posts = new \App\Posts();
            $posts->message = $message;
            $posts->save();
            return $posts;
        }
        return FALSE;
    }

    public static function addInfoToPost($type, $id_post, $data) {
        $post = \App\Posts::where('id', '=', $id_post)->first();
        if ($post) {
            switch ($type) {
                case 'images':
                    $post->images = $data;
                    break;
                case 'street':
                    $post->street = $data;
                    break;
                case 'ward':
                    $post->ward = $data;
                    break;
                case 'province':
                    $post->province = $data;
                    break;
                case 'zone':
                    $post->zone = $data;
                    break;
                case 'district':
                    $post->district = $data;
                    break;
            }
            $post->save();
            return $post;
        }
        return false;
    }

}
