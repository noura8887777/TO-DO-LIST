@component('mail::message')
    bonjour {{$user->name}}
    <ul>
@forelse ($taskPendingNotifiy as $task)
    <li>{{$task->title}}</li>
@empty
   <p>tableau vide</p> 
@endforelse
    </ul>
@component('mail::button', ['url' => url('/tasks/status:pending')])
Voir les tâches en attente
@endcomponent
Thanks,
@endcomponent