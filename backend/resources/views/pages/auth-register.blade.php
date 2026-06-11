<div class="min-h-screen flex">
    <!-- Kiri -->
    <div class="w-3/5 bg-gray-500 flex items-center justify-center">
        <img src="/images/Kamar Besar.jpg" alt="kamar haha" class="w-full h-full object-cover">
    </div>

    <!-- Kanan -->
    <div class="w-2/5 flex items-center justify-center bg-white p-8">
        <form class="w-full max-w-md space-y-4">

            <div class="flex flex-col gap-2">  
                <h1 class="text-3xl font-semibold">Sign Up Account</h1>
                <span class="text-[12px] text-gray-400">Create your account to get started and enjoy all available features.</span>
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

                <div class="flex flex-col gap-2">
                    <span class="text-[15px] font-semibold">Confirm Password</span>
                    <div id="password-wrapper" class="relative">
                        <input 
                            id="Confirmpassword"
                            type="password"
                            placeholder="Masukan Password..."
                            class="w-full px-4 py-3 text-[12px] bg-white rounded border border-gray-300">
                        
                        <button 
                            type="button"
                            id="toggleConfirmpassword" 
                            class="absolute flex items-center right-4 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer">

                            <iconify-icon 
                                id="eyeOpenConfirm"
                                icon="mdi:eye-outline"
                                width="20">
                            </iconify-icon>

                            <iconify-icon
                                id="eyeCloseConfirm" 
                                icon="mdi:eye-off-outline"
                                width="20"
                                class="hidden">
                            </iconify-icon>
                        </button>
                    </div>
                </div>
            </div>

            <button class="w-full bg-black font-semibold text-white py-3 rounded-md mt-2 hover:bg-[#2e2e2e] transition cursor-pointer">
                Create Account
            </button>

            <p class="flex items-center justify-center text-gray-500 text-[12px] gap-1">
                Already have an account? 
                <a href="/login" class="font-semibold text-black hover:text-gray-600 transition">
                    Login
                </a>
            </p>
        </form>
    </div>
</div>