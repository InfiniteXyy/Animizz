<template>
  <el-container direction="vertical">
    <mheader></mheader>
    <el-main>
      <keep-alive> <router-view></router-view> </keep-alive>
    </el-main>
  </el-container>
</template>

<script>
import mheader from '@/components/Header.vue'
import sidebar from '@/components/Sidebar.vue'
import mine from '@/components/Mine.vue'
import explore from '@/components/Explore.vue'
import all from '@/components/AnimeList.vue'
import info from '../utils/global.js'
import http from '../utils/http.js'
export default {
  name: 'home',
  mounted () {
    const res = http.get('user/profile', {uid: info.uid})
    res.then((data) => {
      if (data.data.avatar === '') {
        data.data.avatar = 'http://api.infinitex.cn/res/placeholder.jpg'
      }
      info.profile = data.data
    })
  },
  components: {
    mheader,
    sidebar,
    mine,
    explore,
    all
  }
}
</script>

<style>
.el-container {
  background-color: #f5f7fb;
  height: 100%;
}
</style>
