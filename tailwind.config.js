const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                "gradient-pulse": "gradientPulse 3s ease-in-out infinite",
                float: "float 3s ease-in-out infinite",
                "float-delay": "floatDelay 5s ease-in-out infinite",
                "pulse-once": "pulseOnce 2s ease-in-out",
                fade: "fade 1.5s ease-in-out infinite",
                slideUp: "slideUp 1.5s ease-out forwards",
                "fade-in": "fadeIn 1.5s ease-out forwards", // Fixed here
            },
            keyframes: {
                gradientPulse: {
                    "0%": { backgroundPosition: "0% 0%" },
                    "50%": { backgroundPosition: "100% 100%" },
                    "100%": { backgroundPosition: "0% 0%" },
                },
                float: {
                    "0%": { transform: "translateY(0px)" },
                    "50%": { transform: "translateY(-10px)" },
                    "100%": { transform: "translateY(0px)" },
                },
                floatDelay: {
                    "0%": { transform: "translateY(0px)" },
                    "50%": { transform: "translateY(15px)" },
                    "100%": { transform: "translateY(0px)" },
                },
                fade: {
                    "0%": { opacity: "0" },
                    "50%": { opacity: "1" },
                    "100%": { opacity: "0" },
                },
                slideUp: {
                    "0%": { transform: "translateY(10px)", opacity: "0" },
                    "100%": { transform: "translateY(0px)", opacity: "1" },
                },
                pulseOnce: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                fadeIn: {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
