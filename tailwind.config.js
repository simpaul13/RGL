import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("daisyui")],

    daisyui: {
        themes: [
            {
                mytheme : {
                    "primary": "#4f46e5",
                    "secondary": "#6b7280",
                    "accent": "#d97706",
                    "neutral": "#d6d3d1",
                    "base-100": "#f3f4f6",
                    "info": "#60a5fa",
                    "success": "#4ade80",
                    "warning": "#fbbf24",
                    "error": "#dc2626",
                }
            }
        ],
    },
};
