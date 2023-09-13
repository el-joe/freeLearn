<!-- navbar -->
<div class="w-full text-gray-700 bg-cream" id="overlay">
    <div class="flex flex-col max-w-screen-xl px-8 mx-auto sm:items-center sm:justify-between sm:flex-row">
        <div class="flex flex-row items-center justify-between py-6">
            <div class="relative sm:mt-8">
                <a href="/"
                    class="freelearnLogo text-lg text-white relative z-50 font-bold tracking-widest rounded-lg focus:outline-none focus:shadow-outline">Free
                    Learn Eg</a>
                <svg class="h-11 z-40 absolute -top-2 -left-3" viewBox="0 0 79 79" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M35.2574 2.24264C37.6005 -0.100501 41.3995 -0.100505 43.7426 2.24264L76.7574 35.2574C79.1005 37.6005 79.1005 41.3995 76.7574 43.7426L43.7426 76.7574C41.3995 79.1005 37.6005 79.1005 35.2574 76.7574L2.24264 43.7426C-0.100501 41.3995 -0.100505 37.6005 2.24264 35.2574L35.2574 2.24264Z"
                        fill="#65DAFF" />
                </svg>
            </div>
            <button class="rounded-lg sm:hidden focus:outline-none focus:shadow-outline" id="burger">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>

                </svg>
            </button>
        </div>
        <nav id="nav"
            class="h-0  flex flex-col sm:flex-row sm:items-center pb-4 sm:pb-0 sm:justify-en bg-white sm:bg-transparent ">
            <button class="rounded-lg sm:hidden focus:outline-none focus:shadow-outline absolute right-10 top-10" id="burgerClose">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="open" fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>

                </svg>
            </button>

            <a class="px-4 py-2 mt-2 text-lg font-medium mr-auto bg-transparent rounded-lg sm:mt-8 sm:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                href="/contact-us">Contact Us</a>


            @auth('user')
            <a class="px-4 py-2 mt-2 text-lg font-medium mr-auto bg-transparent rounded-lg sm:mt-8 sm:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                href="/">{{auth('user')->user()->name}}</a>

            <a class="px-4 py-2 mt-2 text-lg font-medium mr-auto bg-transparent rounded-lg sm:mt-8 sm:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                href="/checkout">Buy Now</a>

            <a href="/previous-carts" role="button" class="relative flex mt-5">
                <svg class="flex-1 w-8 h-8 fill-current" viewbox="0 0 24 24">
                    <path d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z"/>
                </svg>
                <span class="absolute right-0 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm  leading-tight text-center">{{auth('user')->user()->videos??0}}</span>
            </a>

            @else

                <a class="px-4 py-2 mt-2 text-lg font-medium mr-auto bg-transparent rounded-lg sm:mt-8 sm:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                    href="/register">Register</a>

                <a class="px-4 py-2 mt-2 text-lg font-medium mr-auto bg-transparent rounded-lg sm:mt-8 sm:ml-4 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                    href="/login">Login</a>

            @endauth

            <div class="sm:hidden">

                @include('web.layout.footer')
            </div>
        </nav>
    </div>
</div>

<script>
    const nav = document.getElementById('nav');
    const burger = document.getElementById('burger');
    const burgerClose = document.getElementById('burgerClose');


    burger.addEventListener('click', () => {

        nav.classList.add('active');

    });
    burgerClose.addEventListener('click', () => {

        nav.classList.remove('active');

    });
</script>

<style>
    /* in mobile only */
    @media (max-width: 576px) {
        #nav {
            background-color: #252641;
            height: 100vh;
            position: fixed;
            width: 100vw;
            left: 0;
            padding-top: 100px;
            color: white;
            transform: translateX(-100%);
            transition: transform 0.3s linear;
            margin-right: 200px;
            z-index: 50;
        }

        #nav.active {

            transform: translateX(0);
        }
    }
</style>
