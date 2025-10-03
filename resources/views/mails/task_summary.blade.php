<h3>You have {{ $count }} pending tasks:</h3>
<ul>
    @foreach($tasks as $task)
        <li>{{ $task->title }} - поле "детали": {{ $task->details ?? 'N/A' }}</li>
    @endforeach
</ul>
