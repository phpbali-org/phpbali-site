module.exports = {
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
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
