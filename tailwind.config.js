/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    darkMode: "class",
    theme: {
        extend: {
            // fontFamily: {
            //     primary: "Usmani",
            // },
            zIndex: {
                100: "100",
                200: "200",
                300: "300",
                400: "400",
                500: "500",
                600: "600",
                700: "700",
                800: "800",
                900: "900",
            },
            backgroundImage: {
                "hero-pattern": "url('/bakid/img/hero_pattern.jpg')",
                "footer-texture": "url('/img/footer-texture.png')",
            },
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
                primary: {
                    50: "#f2fcf1",
                    100: "#defade",
                    200: "#c1f2c0",
                    300: "#8ee78f",
                    400: "#55d357",
                    500: "#2bab2d",
                    600: "#219823",
                    700: "#1d781f",
                    800: "#1c5f1d",
                    900: "#194e1b",
                    950: "#082b0b",
                },
                atlantis: {
                    50: "#f4fee7",
                    100: "#e7fccb",
                    200: "#cff99d",
                    300: "#aef264",
                    400: "#8fe734",
                    500: "#73d216",
                    600: "#55a30d",
                    700: "#417c0f",
                    800: "#366212",
                    900: "#2f5314",
                    950: "#162e05",
                },
                danube: {
                    50: "#f3f7fb",
                    100: "#e3edf6",
                    200: "#cee0ef",
                    300: "#abcce5",
                    400: "#83b2d7",
                    500: "#729fcf",
                    600: "#537fbd",
                    700: "#486dad",
                    800: "#3f5a8e",
                    900: "#374c71",
                    950: "#253046",
                },
                chilean: {
                    50: "#fffaec",
                    100: "#fff4d3",
                    200: "#ffe5a5",
                    300: "#ffd06d",
                    400: "#ffb032",
                    500: "#ff960a",
                    600: "#f57900",
                    700: "#cc5c02",
                    800: "#a1470b",
                    900: "#823c0c",
                    950: "#461c04",
                },
                mantis: {
                    50: "#f6faf3",
                    100: "#e9f5e3",
                    200: "#d3eac8",
                    300: "#afd89d",
                    400: "#82bd69",
                    500: "#61a146",
                    600: "#4c8435",
                    700: "#3d692c",
                    800: "#345427",
                    900: "#2b4522",
                    950: "#13250e",
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
        require("flowbite/plugin"),
    ],
};
