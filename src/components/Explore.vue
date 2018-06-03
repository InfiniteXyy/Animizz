<template>
<el-main>
  <keep-alive> <router-view></router-view> </keep-alive>
</el-main>

</template>

<script>
import anime from '@/components/Anime.vue'
import allAnime from '@/components/AllAnime.vue'

export default {
  components: {
    anime,
    allAnime
  }
}
</script>
