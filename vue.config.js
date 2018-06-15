module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'https://kitsu.io/',
        changeOrigin: true,
        secure: false
      },
      '/v1': {
        target: 'http://api.infinitex.cn/',
        changeOrigin: true,
        secure: false
      }
    }
  }
}
