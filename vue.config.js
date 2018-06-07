module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'https://kitsu.io/',
        changeOrigin: true,
        secure: false
      },
      '/animizz': {
        target: 'http://127.0.0.1:8080/',
        secure: false
      }
    }
  }
}
