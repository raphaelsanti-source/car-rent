<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-0">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div class="flex items-center">
                    <a href="/" class="flex">
                        <span class="font-semibold text-gray-500 text-lg"
                            >CarRent</span
                        >
                    </a>
                </div>
            </div>
            <div class="hidden md:flex items-center">
                <a
                    href="#/login"
                    class="py-5 px-3 font-semibold hover:text-white hover:bg-blue-500 transition duration-300"
                    >Zaloguj się</a
                >
                <a
                    href="#/register"
                    class="py-5 px-3 font-semibold hover:text-white hover:bg-blue-500 transition duration-300"
                    >Zarejestruj się</a
                >
            </div>
            <div class="md:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg
                        class=" w-6 h-6 text-gray-500 hover:text-blue-500"
                        x-show="!showMenu"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div id="dropdown" class="hidden mobile-menu">
        <ul class="menuUl">
            <li>
                <a
                    href="/about"
                    class="block text-sm px-4 py-3 hover:bg-blue-500 hover:text-white transition duration-300"
                    >O nas</a
                >
            </li>
            <li>
                <a
                    href="/doctors"
                    class="block text-sm px-4 py-3 hover:bg-blue-500 hover:text-white transition duration-300"
                    >Lekarze</a
                >
            </li>
            <li>
                <a
                    href="/contact"
                    class="block text-sm px-4 py-3 hover:bg-blue-500 hover:text-white transition duration-300"
                    >Kontakt</a
                >
            </li>
        </ul>
    </div>
</nav>
