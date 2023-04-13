import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [vue()],
    server: {
        host: "0.0.0.0",
        port: 3000,
        hmr: {
            host: "base.test",
            clientPort: 443,
            protocol: "wss"
        }
    }
});
