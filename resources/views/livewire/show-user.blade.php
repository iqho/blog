<div>
    <ul>  
        @foreach ($users as $user)
           <li>{{ $user->username }}</li>
        @endforeach
    </ul>
</div>
