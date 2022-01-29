<?php

/**
 * Construct the payload sent to the Discord API
 * @param $url of Discord webhook
 */
class DiscordWebhook {
    public $post_fields = ['embeds' => []];

    function __construct($url) {
        $this->url = $url;
    }

    function content($content) {
        $this->post_fields['content'] = $content;

        return $this;
    }

    function username($username) {
        $this->post_fields['username'] = $username;

        return $this;
    }

    function avatar_url($avatar_url) {
        $this->post_fields['avatar_url'] = $avatar_url;

        return $this;
    }

    function textToSpeech() {
        $this->post_fields['tts'] = true;

        return $this;
    }

    function addEmbed($embed) {
        array_push($this->post_fields['embeds'], $embed);

        return $this;
    }

    function allowed_mentions($types) {
        $this->post_fields['allowed_mentions'] = ['parse' => $types];

        return $this;
    }

    /**
     * Return response from the Discord API
     */
    function send() {
        $this->post_fields = json_encode($this->post_fields);

        $headers = ['Content-Type: application/json; charset=utf-8'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post_fields);

        return curl_exec($ch);
    }
}

class EmbedBuilder {
    public $embed = [
        'type' => 'rich',
        'fields' => [],
        'provider' => [
            'name' => 'ivolong/DiscordWebhook',
            'url' => 'https://github.com/ivolong/DiscordWebhook'
        ]
    ];

    function title($title) {
        $this->embed['title'] = $title;

        return $this;
    }

    function title_url($title_url) {
        $this->embed['url'] = $title_url;

        return $this;
    }

    function description($description) {
        $this->embed['description'] = $description;

        return $this;
    }

    function timestamp($timestamp = null) {
        if ($timestamp) {
            $this->embed['timestamp'] = $timestamp;
        } else {
            $this->embed['timestamp'] = date('c', time());
        }

        return $this;
    }

    function color($color) {
        $this->embed['color'] = $color;

        return $this;
    }

    function footer($footer) {
        $this->embed['footer'] = $footer;

        return $this;
    }

    function author($author) {
        $this->embed['author'] = $author;

        return $this;
    }

    function addField($field) {
        array_push($this->embed['fields'], $field);

        return $this;
    }

    function thumbnail($thumbnail_url) {
        $this->embed['thumbnail'] = [
            'url' => $thumbnail_url,
            'proxy_url' => $thumbnail_url
        ];

        return $this;
    }

    function image($image_url) {
        $this->embed['image'] = [
            'url' => $image_url,
            'proxy_url' => $image_url
        ];

        return $this;
    }
}