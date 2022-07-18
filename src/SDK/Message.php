<?php

namespace xXutianyi\WecomSdk\SDK;

use xXutianyi\WecomAuth\Config;
use xXutianyi\WecomAuth\SDK;
use xXutianyi\WecomSdk\Modal\Article;

class Message extends SDK
{
    const MESSAGE_SEND = "/message/send";

    private $toUser;
    private $toParty;
    private $toTag;
    private $params;
    private $safe;
    private $idTrans;
    private $duplicateCheck;
    private $interval;

    public function __construct(Config $config, array $toUser = [], array $toParty = [], array $toTag = [], int $safe = 0, int $idTrans = 0, int $duplicateCheck = 0, int $interval = 1800)
    {
        foreach ($toUser as $value) {
            $this->toUser .= $value . '|';
        }

        foreach ($toParty as $value) {
            $this->toParty .= $value . '|';
        }

        foreach ($toTag as $value) {
            $this->toTag .= $value . '|';
        }

        $this->safe = $safe;
        $this->idTrans = $idTrans;
        $this->duplicateCheck = $duplicateCheck;
        $this->interval = $interval;

        $this->params = [
            "touser" => $this->toUser,
            "toparty" => $this->toParty,
            "totag" => $this->toTag,
            "agentid" => $config->AgentID,
            "safe" => $this->safe,
            "enable_id_trans" => $this->idTrans,
            "enable_duplicate_check" => $this->duplicateCheck,
            "duplicate_check_interval" => $this->interval,
        ];
        parent::__construct($config);
    }

    public function text(string $message)
    {
        $params = [
            "msgtype" => "text",
            "text" => [
                "content" => $message
            ],
        ];

        $params = array_merge($this->params, $params);

        return $this->httpPost(self::MESSAGE_SEND, [], $params);
    }

    /**
     * @param Article[] $articles
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function article(array $articles): mixed
    {
        $params = [
            "msgtype" => "mpnews",
            "mpnews" => [
                "articles" => $articles
            ],
        ];

        $params = array_merge($this->params, $params);

        return $this->httpPost(self::MESSAGE_SEND, [], $params);
    }

}