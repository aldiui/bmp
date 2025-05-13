import preset from './vendor/filament/support/tailwind.config.preset'
import colors from 'tailwindcss/colors'

export default {
    presets: [
        preset,
    ],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/masmerise/livewire-toaster/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
        },
    },
}