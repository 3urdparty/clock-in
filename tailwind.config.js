/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{js,ts,jsx,tsx,vue}",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                blue: {
                    100: "#EBF8FF",
                    200: "#BEE3F8",
                    300: "#90CDF4",
                    400: "#63B3ED",
                    500: "#0795F1",
                    600: "#3182CE",
                    700: "#2B6CB0",
                    800: "#2C5282",
                    900: "#2A4365",
                },
            },
        },
    },

    plugins: [
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
};
