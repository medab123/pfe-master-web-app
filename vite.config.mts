import { fileURLToPath, URL } from "node:url";
import path from "path"; // Ajoute cette ligne
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/ts/app.ts"],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "vue-i18n": "vue-i18n/dist/vue-i18n.cjs.js",
            "@": path.resolve(__dirname, "resources/ts"),
        },
    },
    build: {
        chunkSizeWarningLimit: 3000,
    },
});
