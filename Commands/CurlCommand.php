<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Exception;
use GuzzleHttp\Client;
use Longman\TelegramBot\Commands\UserCommand;
use GuzzleHttp\Exception\RequestException;
use Longman\TelegramBot\Request;

/**
 * User "/slap" command
 *
 * Slap a user around with a big trout!
 */
class CurlCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'curl';

    /**
     * @var string
     */
    protected $description = 'Curl commnad';

    /**
     * @var string
     */
    protected $usage = '/curl';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    private $owm_api_base_uri = 'https://api.github.com/users/trungx';

    /**
     * Get weather data using HTTP request
     *
     * @param string $location
     *
     * @return string
     */
    private function callApi($url)
    {
        $client = new Client(['base_uri' => $url]);
        $path   = '';
        $query  = [
            // 'q'     => $param,
            // 'units' => 'metric',
            // 'APPID' => trim($this->getConfig('owm_api_key')),
        ];

        try {
            $response = $client->get($path, ['query' => $query]);
        } catch (RequestException $e) {
            TelegramLog::error($e->getMessage());
            return '';
        }

        return (string) $response->getBody();
    }
    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $text    = $message->getText(true);
        $array = explode(" ", $text);
        if (count($array) > 2) {
            $result = "invalid command!";
        } else {
            $result = json_encode($array);
            if (strtolower($array[0]) == "post" || strtolower($array[0]) == "get") {
            	$result = "call guzzle api";
            } else {
            	$result = "invalid method";
            }
        }
        //$sender = '@' . $message->getFrom()->getUsername();

        //username validation
        // $test = preg_match('/@[\w_]{5,}/', $text);
        // if ($test === 0) {
        //     $text = $sender . ' sorry no one to slap around..';
        // } else {
        //     $text = $sender . ' slaps ' . $text . ' around a bit with a large trout';
        // }

        $data = [
            'chat_id' => $chat_id,
            'text'    => $this->callApi($array[1]), // Set message to send
        ];

        return Request::sendMessage($data);
    }
}
