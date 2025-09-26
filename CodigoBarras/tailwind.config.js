/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./**/*.html",
    "./**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        // Exemplo de como nomear as cores da sua paleta
        'primary': '#96A78D',  // Cor principal mais escura
        'secondary': '#B6CEB4', // Cor secundária de destaque
        'tertiary': '#D9E9CF',  // Cor terciária ou de fundo mais clara
        'background-light': '#F0F0F0', // Seu cinza/branco de fundo
      }
    },
  },
  plugins: [],
}

