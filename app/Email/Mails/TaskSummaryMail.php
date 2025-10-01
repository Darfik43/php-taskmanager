<?php

namespace App\Email\Mails;

use Illuminate\Mail\Mailable;

class TaskSummaryMail extends Mailable
{
    public array $tasks;
    public int $count;

    public function __construct(int $count, array $tasks)
    {
        $this->count = $count;
        $this->tasks = $tasks;
    }

    public function build(): TaskSummaryMail
    {
        return $this->subject("Your Task Summary")
            ->view('emails.task_summary');
    }
}
