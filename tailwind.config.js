module.exports = {
  purge: {
    content: [
      "app/**/*.php",
      "resources/**/*.html",
      "resources/**/*.js",
      "resources/**/*.php",
      "resources/**/*.vue"
    ],
    options: {
      whitelist: ['dialog', 'opened']
    }
  },
  theme: {
    extend: {
      inset: {
        '1': '0.25rem',
        '2': '0.5rem'
      },
      zIndex: {
        '1': 1,
        '2': 2
      },
      width: {
        '400px': '400px'
      }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
