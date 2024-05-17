import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        vue(),
    ],
    server: {
        hmr: {
            host: '72b3-37-77-109-128.ngrok-free.app',  // Укажите ваш субдомен ngrok
            protocol: 'wss',
            clientPort: 443  // HTTPS порт
        }
    }
});
