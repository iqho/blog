<x-backend-layout>
    @section('title', 'Dashboard')
    @section('page-css')
    {{-- Custom Page CSS Here --}}
    @endsection

    <!-- Page layout -->
    <div class="card">
        <div class="card-header border border-bottom border-gray g-0 mb-2">
            <h1 class="g-0">Dashboard</h1>
        </div>
        <div class="card-body">
            <div class="card-text">
                @can('isAdmin')
                <livewire:backend.all-users />
                @elsecan('isEditor')
                <h3 class="mb-2">You are Editor !</h3>
                <a class="btn btn-primary" href="{{ route('admin-panel.profile') }}">Update profile Information</a>
                @elsecan('isAuthor')
                <h3 class="mb-2">You are Author !</h3>
                <a class="btn btn-primary" href="{{ route('admin-panel.profile') }}">Update profile Information</a>
                @elsecan('isContributor')
                <h3 class="mb-2">You are Contributor !</h3>
                <a class="btn btn-primary" href="{{ route('admin-panel.profile') }}">Update profile Information</a>
                @else
                <h3 class="mb-2">You are Subscribers !</h3>
                <a class="btn btn-primary" href="{{ route('user.profile') }}">Update profile Information</a>
                @endcan


            </div>
        </div>
    </div>
    <!--/ Page layout -->

    @section('page-js')
    {{-- Javascript Code link Place Here --}}
    @endsection
</x-backend-layout>
