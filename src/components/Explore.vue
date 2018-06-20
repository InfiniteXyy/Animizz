<template>
<div class="page">
  <el-carousel :interval="5000" indicator-position="inside">
    <el-carousel-item v-for="item in trendingList" :key="item.a_id">
      <img class="cover" :src="item.coverUrl" alt="Image" />
    </el-carousel-item>
  </el-carousel>
  <b class="title">本周热点
    <span class="sub-title">More</span>
  </b>
  <el-row :gutter="12">
    <el-col :span="4" v-for="anime in trendingList" :key="anime.a_id">
      <el-popover placement="right" width="270" trigger="hover" :title="anime.title">
        <popup :data='anime'></popup>
        <el-card shadow="never" :body-style="{ padding: '0px' }" slot="reference">
          <img :src="anime.posterUrl" style="width:100%; margin-bottom: -10px;" @click="clickAnime(anime)" alt="image">
        </el-card>
      </el-popover>
    </el-col>
  </el-row>
  <b class="title">正在观看
    <span class="sub-title">More</span>
  </b>
  <el-row :gutter="12">
    <el-col :span="4" v-for="anime in watchingList" :key="anime.a_id">
      <el-popover placement="right" width="270" trigger="hover" :title="anime.title">
        <popup :data='anime'></popup>
        <el-card shadow="never" :body-style="{ padding: '0px' }" slot="reference">
          <img :src="anime.posterUrl" style="width:100%; margin-bottom: -10px;" @click="clickAnime(anime)" alt="image">
        </el-card>
      </el-popover>
    </el-col>
  </el-row>
  <b class="title">我的关注
    <span class="sub-title">More</span>
  </b>
  <el-dialog :visible.sync="animeDialogVisible" v-if="curAnime">
      <anim :anime="curAnime" />
  </el-dialog>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'
import anim from './AnimeDialog.vue'
import popup from './AnimePopup.vue'

export default {
  data () {
    return {
      trendingList: [],
      watchingList: [],
      commentDialogVisible: false,
      animeDialogVisible: false,
      curAnime: ''
    }
  },
  mounted () {
    this.getData()
    this.loadIsWatching()
  },
  methods: {
    async getData () {
      // 需要一个trending list 的接口
      const res = await http.get('animation/get_list', {})
      this.trendingList = res.data.slice(0, 5)
    },
    routeToAllAnime () {
      alert('sd')
    },
    clickAnime (anime) {
      this.curAnime = anime
      this.animeDialogVisible = true
    },
    loadIsWatching () {
      http.get('user/animation_is_watching', {uid: info.uid}).then((res) => {
        this.watchingList = []
        res.data.forEach(element => {
          this.watchingList.push(element.animation)
        })
      })
    }
  },
  components: {
    anim: anim,
    popup: popup
  }
}
</script>
<style scoped>
  .el-carousel {
    margin-bottom: 30px;
  }
  .page {
    margin: 10px 50px;
    display: block;
  }

  .title {
    margin-top: 10px;
    display: block;
    color: #464646;
    margin-bottom: 10px;
    font-size: 16px;
  }

  .sub-title {
    color: #44617b;
    cursor: pointer;
    margin-left: 10px;
  }

  .el-row {
    margin-bottom: 20px;
  }

  .el-card {
    cursor: pointer;
  }

  .cover {
    height: 100%;
    transform: 0 0 20% 20%
  }
</style>
