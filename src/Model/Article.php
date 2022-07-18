<?php

namespace xXutianyi\WecomSdk\Modal;

use JetBrains\PhpStorm\ArrayShape;

class Article
{
    public string $title;
    public string $thumb_media_id;
    public string $author;
    public string $content_source_url;
    public string $content;
    public string $digest;

    const ARTICLE_PARAMS_SHAPE = [
        "title" => "string",
        "thumb_media_id" => "string",
        "author" => "string",
        "content_source_url" => "string",
        "content" => "string",
        "digest" => "string"
    ];

    #[ArrayShape(self::ARTICLE_PARAMS_SHAPE)]
    public function toArray(): array
    {
        return
            [
                "title" => $this->title,
                "thumb_media_id" => $this->thumb_media_id,
                "author" => $this->author,
                "content_source_url" => $this->content_source_url,
                "content" => $this->content,
                "digest" => $this->digest
            ];
    }
}