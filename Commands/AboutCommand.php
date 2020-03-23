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
class AboutCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'about';

    /**
     * @var string
     */
    protected $description = 'About commnad';

    /**
     * @var string
     */
    protected $usage = '/about';

    /**
     * @var string
     */
    protected $version = '1.1.0';

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
        

        $data = [
            'chat_id' => $chat_id,
            'text'    => 'Bot nè bot nè !!!', // Set message to send
        ];

        return Request::sendMessage($data);
    }
}
