module.exports = {
  devServer: {
    port: 8070,
    proxy: {
      '/v1': {
        target: 'http://api.infinitex.cn/',
        changeOrigin: true,
        secure: false
      }
    }
  }
}
