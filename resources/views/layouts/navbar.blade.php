 <!-- Desktop Header -->
 {{-- {{ Auth::user()}} --}}
 {{-- @dd(Auth::user()->getFirstMediaUrl('profiles')) --}}
 
 <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
            <img
            class="h-full"
             src="{{ Auth::user()->getFirstMediaUrl('profiles') }}"
            {{-- src="{{ asset('profile-picture-icon-circle-member-icon-png.png') }}" --}}
            >

        </button>
        
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
            <a href="profile" class="block px-4 py-2 account-link hover:text-white">Account</a>
            {{-- <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a> --}}
            {{-- <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a> --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</header>

 <!-- Mobile Header & Nav -->
 <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <a href="dashboard" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
        </button>
    </div>

    <!-- Dropdown Nav -->
    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        <a href="dashboard" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="users" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
            Users
        </a>
        <a href="partners" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-table mr-3"></i>
            Partners
        </a>
        <a href="projects" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Projects
        </a>
        <a href="collaborations" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-tablet-alt mr-3"></i>
            Requsets for projects
        </a>
        {{-- <a href="profile" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-calendar mr-3"></i>
            Profile
        </a> --}}
        {{-- <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-cogs mr-3"></i>
            Support
        </a> --}}
        <a href="profile" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-user mr-3"></i>
            My Account
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-arrow-circle-up mr-3"></i> Upgrade to Pro!
        </button>
    </nav>
    <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
        <i class="fas fa-plus mr-3"></i> New Report
    </button> -->
</header>