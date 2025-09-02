// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './app/Filament/**/*.php',
    // Pastikan ini ada jika Anda menggunakan Filament
    './vendor/filament/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};