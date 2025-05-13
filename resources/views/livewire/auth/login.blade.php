<div class="w-full max-w-lg px-8 py-10 bg-white rounded-xl shadow-md">
    <div class="space-y-8">
        <div class="text-center space-y-2">
            <flux:heading size="lg" class="text-gray-800">Login CPMI</flux:heading>
            <img src="{{ asset('logo.png') }}" alt="Logo PT. Bahana Mega Prestasi" class="mx-auto my-4 w-48 object-contain">
        </div>
        <form wire:submit.prevent="login" class="space-y-6">
            <div class="space-y-6">
                <flux:field>
                    <div class="mb-2 flex justify-between">
                        <flux:label class="text-gray-700">Email <span class="text-red-500">*</span></flux:label>
                    </div>
                    <flux:input 
                        type="email" 
                        wire:model.defer="email" 
                        placeholder="Masukan Email" 
                        class="focus:ring-sky-500 focus:border-sky-500" />
                    <flux:error name="email" />
                </flux:field>
                <flux:field>
                    <div class="mb-2 flex justify-between">
                        <flux:label class="text-gray-700">Password <span class="text-red-500">*</span></flux:label>
                    </div>
                    <flux:input 
                        type="password" 
                        wire:model.defer="password" 
                        placeholder="Masukan Password" 
                        viewable 
                        class="focus:ring-sky-500 focus:border-sky-500" />
                    <flux:error name="password" />
                </flux:field>
            </div>
            <div class="pt-2">
                <flux:button 
                    type="submit"
                    variant="primary"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white">
                    <span wire:loading.remove wire:target="login">Login</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>