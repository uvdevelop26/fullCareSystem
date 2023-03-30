const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
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
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                Lobster: ['Lobster'],
                NotoSans: ['Noto Sans'],
                Roboto: ['Roboto'],
                Satisfy: ['Satisfy'],
                Epilogue: ['Epilogue']
            },
            colors: {
                'dark-mountain': '#10ac84',
                'wild-caribean': '#1dd1a1',
                'softIndigo': '#6C63FF',
                'textColor': '#A7A9A8',
                'fondColor': '#F1F1F1'
            },

            width: {
                'screem-20': '20vw',
                'screem-30': '30vw',
                'screem-70': '70vw',
                'screem-80': '80vw',
                '37': '150px'
            },
            height:{
                '85p' : '85%'
            },
            zIndex: {
                '100': '100',
                '200': '200',
                '800': '800'
            },
            padding:{
                'xs': '1px'
            },
            borderSpacing:{
                'cus': ' 0 1em'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
