<x-backend-layout>
    @section('title', 'Dashboard')
    @section('page-css')
    {{-- Custom Page CSS Here --}}
    @endsection

    <!-- Page layout -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Show All User</h2>
        </div>
        <div class="card-body">
            <div class="card-text">
                <livewire:all-users />
                {{-- {{ Auth::user()->name }}

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
                @endcan --}}






            </div>
        </div>
    </div>
    <!--/ Page layout -->

    @section('page-js')
    {{-- Javascript Code link Place Here --}}
    @endsection
</x-backend-layout>