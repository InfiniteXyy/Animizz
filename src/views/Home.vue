<template>
  <el-container direction="vertical">
    <mheader></mheader>
    <el-container>
      <sidebar></sidebar>
      <keep-alive>
      <router-view></router-view>
      </keep-alive>
    </el-container>
  </el-container>
</template>

<script>
import mheader from '@/components/Header.vue'
import sidebar from '@/components/Sidebar.vue'
import mine from '@/components/Mine.vue'
import explore from '@/components/Explore.vue'
import movies from '@/components/Movies.vue'
import animes from '@/components/Animes.vue'
import timeline from '@/components/Timeline.vue'

export default {
  name: 'home',
  components: {
    mheader,
    sidebar,
    mine,
    explore,
    movies,
    animes,
    timeline
  }
}
</script>
