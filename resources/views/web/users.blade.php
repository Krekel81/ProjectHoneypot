<h1>users</h1>

@foreach ($users as $user)
    <p>This is user {{ $user->id }} {{$user->name}} {{$user->password}}</p>
@endforeach