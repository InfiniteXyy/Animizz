<template>
<div v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10" style="margin: 0 80px">
  <el-row :gutter="40">
    <el-col :span="6" v-for="anime in animes" :key="anime.aid" style="min-width: 300px; max-width: 300px">
      <el-card :body-style="{ padding: '0px' }" style="margin-bottom:40px">
        <img :src="anime.posterUrl" class="image" height="370px">
        <div style="padding: 14px;">
          <span class="title">{{ anime.title }}</span>
          <div class="bottom clearfix">
            <el-button type="text" class="button" @click="handleDetail(anime)">查看详情</el-button>
          </div>
        </div>
      </el-card>
    </el-col>
    <el-dialog :visible.sync="dialogVisible" v-if="curAnime">
      <anim :anime="curAnime" />
    </el-dialog>
  </el-row>
  <div v-loading='busy' style="width: 100%; height:100px;" element-loading-background="#f5f7fb"></div>
</div>
</template>

<script>
import anim from './AnimeDialog.vue'
import http from '../utils/http.js'

export default {
  data () {
    return {
      animes: [],
      busy: false,
      dialogVisible: false,
      curAnime: '',
      pageNum: 1
    }
  },
  mounted () {
    this.getData()
  },
  components: {
    anim
  },
  methods: {
    handleDetail (anime) {
      this.dialogVisible = true
      this.curAnime = anime
    },
    loadMore: function () {
      this.busy = true
      setTimeout(this.getData, 500)
    },
    async getData (i) {
      const res = await http.get('animation/get_list', {page: this.pageNum})
      this.pageNum += 1
      for (i of res.data) {
        this.animes.push(i)
      }
      this.busy = false
    }
  }
}
</script>

<style scoped>
  .title {
    max-width: 50px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: left;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }

  .clearfix:after {
      clear: both
  }
</style>
