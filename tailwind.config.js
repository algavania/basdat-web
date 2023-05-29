/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js}",
    "./**/*.{html,js,php}",
  ],
  theme: {
    fontFamily: {
      sans: ["Plus Jakarta Sans", "sans-serif"],
    },
    extend: {
      colors: {
        primary: "#2363DE",
        white: "#FFFFFF",
        dark: "#1D1D1D",
        dark10: "#D2D2D2",
        dark20: "#A5A5A5",
        dark30: "#777777",
        dark40: "#4A4A4A",
        dark50: "#1D1D1D",
        gray: "#A5A5A5",
      },
    },
  },
  plugins: [require("@tailwindcss/line-clamp")],
};
