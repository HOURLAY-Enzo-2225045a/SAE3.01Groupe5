/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./view/**/*.php', "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {colors: {
        customBlue: '#00D5FF',
      },
    },
  },
  variants: {},
  plugins: [
    require('flowbite/plugin')
  ],
}
