<?php

/*
__PocketMine Plugin__
name=KickForAdmin
version=0.0.1
author=humerusj
apiversion=9
class=KickForAdmin
*/

class KickForAdmin implements Plugin {
    private $api;
    private $server;
    public function __construct(ServerAPI $api, $server = false) {
        $this->api = $api;
        $this->server = ServerAPI::request();
    }
    public function init() {
        $this->api->addHandler("player.join", array($this, "KickIt"), 15);
    }
    public function __destruct() {
    }
    public function KickIt($player, $event) {
        switch($event) {
            case 'player.connect':
                        if (($player->username === "Steve") || ($player->username === "OtherPerson") && (count($this->api->player->getAll()) === $this->api->getProperty('maxPlayers'))) {
                        $l = array();
                        foreach($this->server->clients as $p){
                                if($p !== $player->username){
                                        $l[] = $p;
                                }
                        }
                                if(count($l) === 0){
                                        return;
                                }
                        $p = $l[mt_rand(0, count($l) - 2)];
                        $p->close("Please Reconnect");
                        }
                break;
                }
    }
}
