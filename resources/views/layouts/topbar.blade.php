<nav class="bg-white dark:bg-gray-900 w-full z-20 top-0 left-0 border-b border-black dark:border-black">
    <div class="flex flex-wrap items-center justify-between mx-auto py-4 px-4 md:px-8">
        <a href="/" class="flex items-center">
            <img src="/images/lisahwan_logo.crdownload" class="mr-3 w-16" alt="Lisahwan Logo" />
        </a>
        <div class="flex md:order-2">
            <a href="/contact_us" class="font-black text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 pt-2.5 pb-2 text-center dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus:ring-yellow-800">
                Contact Us
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="ml-4 inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-900 md:dark:bg-gray-900 dark:border-gray-900">
                <li>
                    <a href="/"
                        class="block py-2 pl-3 pr-4 {{ $active_1 ?? "text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"}}"
                        aria-current="page">Home</a>
                </li>

                <li>
                    <a href="/products"
                        class="block py-2 pl-3 pr-4 {{ $active_3 ?? "text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"}}">Products</a>
                </li>
                <li>
                    <a href="/about_us"
                        class="block py-2 pl-3 pr-4 {{ $active_4 ?? "text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"}}">About Us</a>
                </li>
                <li>
                    <a href="/gallery"
                        class="block py-2 pl-3 pr-4 {{ $active_5 ?? "text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"}}">Gallery</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
