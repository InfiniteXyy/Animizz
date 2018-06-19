<template>
  <div id="app">
    <keep-alive include="home"><router-view/></keep-alive>
  </div>
</template>

<script>
export default {
  methods: {
    checkLogin () {
      // 验证cookie
      // if (false) {
      //   this.$router.push('/animizz/explore')
      //   return
      // }
      this.$router.push('/login')
    }
  },
  created () {
    this.checkLogin()
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  height: 100%;
}
.wrapper {
  display: flex;
}
</style>
