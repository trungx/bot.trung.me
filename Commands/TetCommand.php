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
use Carbon\Carbon;

/**
 * User "/slap" command
 *
 * Slap a user around with a big trout!
 */
class TetCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'tet';

    /**
     * @var string
     */
    protected $description = 'Tet commnad';

    /**
     * @var string
     */
    protected $usage = '/tet';

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
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        Carbon::setLocale('vi');
        $lunarNewYear = "2020-01-25 00:00:00";
        $newYear = "2020-01-01 00:00:00";
        $today = Carbon::now();

        $chat_id = $message->getChat()->getId();
        
        
        $space1 = Carbon::parse($lunarNewYear)->diff(Carbon::now());
        $space = Carbon::parse($newYear)->diff(Carbon::now());
        $result = "Còn " . $space->d . " ngày " . $space->h . " giờ " . $space->i . " phút " . $space->s . " giây nữa là tới tết dương!" . "\n";
        $result .= "Còn " . $space1->d . " ngày " . $space1->h . " giờ " . $space1->i . " phút " . $space1->s . " giây nữa là tới tết âm!";
        $data = [
            'chat_id' => $chat_id,
            'text'    => $result,// . "\n"; Carbon::parse($lunarNewYear)->floatDiffInDays(Carbon::now()), // Set message to send
        ];

        return Request::sendMessage($data);
    }
}
