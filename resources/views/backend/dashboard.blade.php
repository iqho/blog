<x-backend-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
             
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

                
            </div>
        </div>
    </div>
</x-backend-layout>