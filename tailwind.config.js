import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/laravel/pulse/resources/views/**/*.blade.php",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                bounce: "bounce 1s infinite",
                shake: "shake 0.82s cubic-bezier(.36,.07,.19,.97) both",
            },
            keyframes: {
                bounce: {
                    "0%, 100%": {
                        transform: "translateY(-25%)",
                        animationTimingFunction: "cubic-bezier(0.8,0,1,1)",
                    },
                    "50%": {
                        transform: "none",
                        animationTimingFunction: "cubic-bezier(0,0,0.2,1)",
                    },
                },
                shake: {
                    "10%, 90%": {
                        transform: "translate3d(-1px, 0, 0)",
                    },
                    "20%, 80%": {
                        transform: "translate3d(2px, 0, 0)",
                    },
                    "30%, 50%, 70%": {
                        transform: "translate3d(-4px, 0, 0)",
                    },
                    "40%, 60%": {
                        transform: "translate3d(4px, 0, 0)",
                    },
                },
            },
        },
    },

    plugins: [forms, typography],
};
