
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ Auth::user()->name }}

            @if(Auth::check() && Auth::user()->user_type == "1")
            {{ __('Admin Dashboard') }}
            @else
            {{ __('User Dashboard') }}
            @endif

            @can('isAdmin')
            <div class="btn btn-success btn-lg">
                You have Admin Access
            </div>
            @else
            <div class="btn btn-info btn-lg">
                You have User Access
            </div>
            @endcan

        </h2>

        <h1>Display All User Using Livewire</h1>
        <ul>  
            @foreach ($users as $user)
               <li>{{ $user->username }}</li>
            @endforeach
        </ul>