module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        main: "#D8315B",
        darkest: "#0e1212",
        whiter: "#fffaff",
        blu: '#3e92cc',
        redish: '#EF3B2D'
      }
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}