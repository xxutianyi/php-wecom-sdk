<?php

namespace xXutianyi\WecomSdk\SDK;

use xXutianyi\WecomAuth\Config;
use xXutianyi\WecomAuth\SDK;

class Message extends SDK
{
    const MESSAGE_SEND = "/message/send";

    private $toUser;
    private $toParty;
    private $toTag;
    private $params;

    public function __construct(Config $config, array $toUser, array $toParty, array $toTag)
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

        $this->params = [
            "touser" => $this->toUser,
            "toparty" => $this->toParty,
            "totag" => $this->toTag,
            "agentid" => $config->AgentID,
            "safe" => 1,
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

        return $this->post(self::MESSAGE_SEND, [], $params);
    }

}