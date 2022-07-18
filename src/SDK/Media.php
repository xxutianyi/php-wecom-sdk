<?php

namespace xXutianyi\WecomSdk\SDK;

use xXutianyi\WecomAuth\SDK;

class Media extends SDK
{
    const MEDIA_UPLOAD = "/media/upload";
    const MEDIA_UPLOAD_IMAGE = "/media/uploadimg";
    const MEDIA_GET = "/media/get";

    public function upload($filePath, string $fileName, string $type = "file"): array
    {
        $data = array('media' => new \CURLFile(realpath($filePath), 'application/octet-stream', $fileName));

        $url = self::BASE_URL . self::MEDIA_UPLOAD . "?access_token=$this->AccessToken&type=$type";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);

        return $this->unpackResponse($response);
    }

    public function uploadImage($filePath): array
    {
        $data = array('media' => new \CURLFile(realpath($filePath), 'application/octet-stream', basename($filePath)));

        $url = self::BASE_URL . self::MEDIA_UPLOAD_IMAGE . "?access_token=$this->AccessToken";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);

        return $this->unpackResponse($response);
    }

    public function get($mediaID): array
    {
        $query = [
            'media_id' => $mediaID
        ];
        return $this->httpGet(self::MEDIA_GET, $query);
    }
}