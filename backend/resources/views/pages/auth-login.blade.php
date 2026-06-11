<div class="min-h-screen flex">
    <!-- Kiri -->
    <div class="relative w-3/5 overflow-hidden">
        <div id="carouselWrapper" class="flex transition-transform duration-700 ease-in-out h-full">
            <div class="min-w-full h-full">
                <img src="/images/Kamar Besar.jpg" alt="kamar haha" class="w-full h-full object-cover">
            </div>

            <div class="min-w-full h-full">
                <img src="/images/Kamar Besar.jpg" alt="kamar haha" class="w-full h-full object-cover">
            </div>

            <div class="min-w-full h-full">
                <img src="/images/Kamar Besar.jpg" alt="kamar haha" class="w-full h-full object-cover">
            </div>

            <div class="min-w-full h-full">
                <img src="/images/Kamar Besar.jpg" alt="kamar haha" class="w-full h-full object-cover">
            </div>
        </div>

        <div id="indicators" class="absolute bottom-3 -translate-x-1/2 left-1/2 flex gap-2 z-10"></div>
    </div>

    <!-- Kanan -->
    <div class="w-2/5 flex items-center justify-center bg-white p-8">
        <form class="w-full max-w-md space-y-4">

            <div class="flex flex-col gap-2">  
                <h1 class="text-3xl font-semibold">Wellcome Back!</h1>
                <span class="text-[12px] text-gray-400">Enter your credentials to access your account.</span>
            </div>

            <div class="space-y-4">
                <div class="flex flex-col gap-2">
                    <span class="text-[15px] font-semibold">Email</span>
                    <input type="text"
                    placeholder="Masukan Email..."
                    class="px-4 py-3 text-[12px] bg-white rounded border border-gray-300">
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-[15px] font-semibold">Password</span>

                    <div class="relative">
                        <input 
                            id="password"
                            type="password"
                            placeholder="Masukan Password..."
                            class="w-full px-4 py-3 text-[12px] bg-white rounded border border-gray-300">

                        <button 
                            type="button"
                            id="togglePassword" 
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer">
                            <iconify-icon
                                id="eyeOpen" 
                                icon="mdi:eye-outline"
                                width="20"
                               >
                            </iconify-icon>

                            <iconify-icon 
                                id="eyeClose"
                                icon="mdi:eye-off-outline"
                                width="20"
                                class="hidden">
                            </iconify-icon>
                        </button> 
                    </div>
                </div>
            </div>

            <a  href="/forgot-password"
                class="font-semibold text-black hover:text-gray-500 transition text-[15px] mb-2">Forgot Password?</a>
          
            <button class="w-full bg-black font-semibold text-white py-3 rounded-md mt-2 hover:bg-[#2e2e2e] transition cursor-pointer">
                Login
            </button>

            <p class="flex items-center justify-center text-gray-500 text-[12px] gap-1">
                Don't have an account? 
                <a href="/register" class="font-semibold text-black hover:text-gray-600 transition">
                    Sign Up
                </a>
            </p>
        </form>
    </div>
</div>