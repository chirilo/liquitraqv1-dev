import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                //sans: ['RethinkSansBold', 'RethinkSansBoldItalic', 'RethinkSansExtraBold', 'RethinkSansExtraBoldItalic', 'RethinkSansItalic', 'RethinkSansMedium', 'RethinkSansMediumItalic', 'RethinkSansRegular', 'RethinkSansSemiBold', 'RethinkSansSemiBoldItalic', ...defaultTheme.fontFamily.sans],
                rethinksansbold: ['RethinkSans-Bold'],
                rethinksansbolditalic: ['RethinkSans-BoldItalic'],
                rethinksansextrabold: ['RethinkSans-ExtraBold'],
                rethinksansextrabolditalic: ['RethinkSans-ExtraBoldItalic'],
                rethinksansitalic: ['RethinkSans-Italic'],
                rethinksansmedium: ['RethinkSans-Medium'],
                rethinksansmediumitalic: ['RethinkSans-MediumItalic'],
                rethinksansregular: ['RethinkSans-Regular'],
                rethinksanssemibold: ['RethinkSans-SemiBold'],
                rethinksanssemibolditalic: ['RethinkSans-SemiBoldItalic'],
            },
        },
    },

    plugins: [forms, typography],
};
