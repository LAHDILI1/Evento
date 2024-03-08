<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="../" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
        <a href="categories">
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> New Category
        </button>
        </a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="dashboard" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="users" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
            Users
        </a>
        <a href="categories" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
            Categories
        </a>
        <a href="events" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Events
        </a>
        
         
        <a href="profile" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-tablet-alt mr-3"></i>
            Profile
        </a>
    </nav>
    <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
        <i class="fas fa-arrow-circle-up mr-3"></i>
        Upgrade to Pro!
    </a>
</aside>