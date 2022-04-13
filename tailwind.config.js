const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/tw-elements/dist/js/**/*.js',
    ],

    safelist: [
        {
            pattern: /^(bg|text|border)-status-(done|open)-(light|dark)$/,
        }
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                status: {
                    done: {
                        dark: "#006000",
                        light: "#4eff4e",
                    },
                    open: {
                        dark: "#850000",
                        light: "#ff4545",
                    },
                },
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require('tw-elements/dist/plugin'),
    ],
};
