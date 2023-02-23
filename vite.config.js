import { defineConfig } from 'vite';
import path from "path";

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import resources/assets/style/main.scss`
            }
        }
    }
})