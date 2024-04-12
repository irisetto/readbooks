import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Viga', ...defaultTheme.fontFamily.sans],
                serif: ['Montserrat', 'Georgia'],

            },
            colors:{
                'indig':'#5e7ce2',
            },
        },
    },

    plugins: [forms],
};
