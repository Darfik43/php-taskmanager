<h3>You have {{ $count }} pending tasks:</h3>
<ul>
    @foreach($tasks as $task)
        <li>{{ $task->title }} - due {{ $task->due_date ?? 'N/A' }}</li>
    @endforeach
</ul> нужно проверить, что напрямую это письмо уйдёт
