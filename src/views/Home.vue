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

export default {
  name: 'home',
  components: {
    mheader,
    sidebar,
    mine,
    explore
  }
}
</script>

<style>
.el-container {
  background-color: #f5f7fb;
  height: 100%;
}
</style>
