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
import animes from '@/components/Animes.vue'

export default {
  name: 'home',
  components: {
    mheader,
    sidebar,
    mine,
    explore,
    animes
  }
}
</script>

<style>

</style>
