module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      'screens': {
        'xs': '340px',
        'sm': '540px',
        '2xl': '1540px',
      },
      width: {
        '128': '32rem',
      },
      spinner: (theme) => ({
        default: {
          color: '#dae1e7', // color you want to make the spinner
          size: '1em', // size of the spinner (used for both width and height)
          border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
          speed: '500ms', // the speed at which the spinner should rotate
        },

      }),
    },

  },
  variants: { // all the following default to ['responsive']
    spinner: ['responsive'],
  },

  plugins: [
    // optional configuration for resulting class name and/or tailwind theme key
    require('tailwindcss-spinner')({ className: 'spinner', themeKey: 'spinner' }),
  ],

}