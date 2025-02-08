/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
    //presets: [preset],
    content: [
      './resources/**/*.blade.php',
      './storage/framework/views/*.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
    theme: {
      extend: {},
    },
    variants: {},
    darkMode: false,

    plugins: [],
  }
  