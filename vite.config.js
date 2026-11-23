import { defineConfig } from 'vite';
import fs from 'node:fs';
import path from 'node:path';

const THEME_URL_PATH = '/wp-content/themes/quality-metteresess';
const hotFile = path.resolve(__dirname, 'hot');

// Writes a `hot` file while the dev server runs so PHP knows to load assets from Vite.
const hotFilePlugin = () => ({
  name: 'qm-hot-file',
  configureServer(server) {
    server.httpServer?.once('listening', () => {
      const { port } = server.httpServer.address();
      fs.writeFileSync(hotFile, `http://localhost:${port}`);
    });
    const cleanup = () => fs.existsSync(hotFile) && fs.unlinkSync(hotFile);
    server.httpServer?.once('close', cleanup);
    process.once('SIGINT', () => { cleanup(); process.exit(); });
    process.once('SIGTERM', () => { cleanup(); process.exit(); });
  },
});

export default defineConfig(({ command }) => ({
  base: command === 'build' ? `${THEME_URL_PATH}/dist/` : '/',
  plugins: [hotFilePlugin()],
  server: {
    host: 'localhost',
    port: 5173,
    strictPort: true,
    cors: true,
    origin: 'http://localhost:5173',
  },
  css: { preprocessorOptions: { scss: { api: 'modern-compiler' } } },
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    assetsInlineLimit: 4096,
    rollupOptions: { input: { main: 'assets/js/main.js' } },
  },
}));
