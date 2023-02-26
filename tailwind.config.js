

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/livewire/*.blade.php",
        "./resources/views/*.blade.php",
        "./resources/views/components/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                roboto_slab: ["Roboto Slab"],
                arquivo: ["Arquivo"]
            }
        },
    },
    plugins: [],
}
