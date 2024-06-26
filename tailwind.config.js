/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    darkMode: "class",
    theme: {
        extend: {
            // fontFamily: {
            //     primary: "Usmani",
            // },
            fontFamily: {
                pjs: ["Plus Jakarta Sans", "sans-serif"],
                culpa: ['"Mea Culpa"', "cursive"],
                amiri: ["Amiri Quran", "serif"],
                noto: ["Noto Naskh Arabic", "sans-serif"],
            },
            colors: {
                wa: {
                    teal1: "#075e54",
                    teal2: "#128c7e",
                    light: "#25d366",
                    tea: "#dcf8c6",
                    blue: "#34b7f1",
                    gray: "#ece5dd",
                },
            },
            animation: { blob: "blob 4s infinite" },
            keyframes: {
                blob: {
                    "0%": {
                        transform: "translate(0px, 0px) scale(1)",
                    },
                    "33%": {
                        transform: "translate(40px, -60px) scale(1.2)",
                    },
                    "66%": {
                        transform: "translate(-30px, 30px) scale(0.8)",
                    },
                    "100%": {
                        transform: "translate(0px, 0px) scale(1)",
                    },
                },
            },
        },
        fontFamily: {
            pjs: ['"Plus Jakarta Sans"', "sans-serif"],
        },
    },
    variants: {
        extend: {
            display: ["group-focus"],
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
