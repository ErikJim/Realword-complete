<?php
namespace App\Controllers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Controllers\BaseController;
use App\Models\CounterModel;

class Welcome extends BaseController {
    
    public function receive() {
        $queue = "article";
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $callback = function ($message) {
            $article = explode(" ", $message->body);
            $counter = 0;
            foreach ($article as $substring) {
                if (strlen($substring) > 2) {
                    $counter = $counter + 1;
                }
            }
            $wordsLength = '';
            for ($i = 1; $i <= 10; $i++) {
                $limit = $i * 10;
                if ($counter < $limit) {
                    $wordsLength = "less-than-" . strval($limit);
                    break;
                } else {
                    $wordsLength = "less-than-100";
                    break;
                }    
            }
            $counterModel = new CounterModel();
            $data = $counterModel->where(['words_length' => $wordsLength])->findAll();
            $sumatory = $counter;
            $id = null;
            foreach ($data as $counter) {
                print_r($counter);
                $id = $counter['id'];
                $sumatory = $sumatory + $counter['articles_comments'];
            }
            $count = [
                'id' => $id,
                'words_length' => $wordsLength,
                'articles_comments'	=> $sumatory,
            ];
            $counterModel->save($count);
        };
        $channel->queue_declare($queue, false, false, false, false);
        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        // Loop as long as the channel has callbacks registered
        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }

}