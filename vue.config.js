module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'https://kitsu.io/',
        changeOrigin: true,
        secure: false
      }
    }
  }
}
