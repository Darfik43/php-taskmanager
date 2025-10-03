<?php

namespace App\Email\Producers;

use RdKafka\Producer;

class TaskNotificationProducer
{
    private Producer $producer;
    private \RdKafka\Topic $topic;

    public function __construct()
    {
        $conf = new \RdKafka\Conf();
        $this->producer = new Producer($conf);
        $this->producer->addBrokers(env('KAFKA_BROKER'));
        $this->topic = $this->producer->newTopic('user_task_notifications');
    }

    public function send(int $userId): void
    {
        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode(['user_id' => $userId]));
        $this->producer->flush(1000);
    }
}
