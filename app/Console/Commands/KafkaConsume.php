<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RdKafka\KafkaConsumer;
use App\Notification\Services\TaskNotificationService;

class KafkaConsume extends Command
{
    protected $signature = 'kafka:consume';
    protected $description = 'Consume Kafka messages for task notifications';

    public function handle(): void
    {
        $conf = new \RdKafka\Conf();
        $conf->set('group.id', 'laravel-task-group');
        $conf->set('metadata.broker.list', env('KAFKA_BROKER'));

        $consumer = new KafkaConsumer($conf);
        $consumer->subscribe(['user_task_notifications']);

        $service = app(TaskNotificationService::class);

        while (true) {
            $message = $consumer->consume(120*1000);
            if ($message->err) {
                continue;
            }

            $data = json_decode($message->payload, true);
            $userId = $data['user_id'] ?? null;

            if ($userId) {
                $service->sendTaskSummaryForUser($userId);
            }
        }
    }
}
