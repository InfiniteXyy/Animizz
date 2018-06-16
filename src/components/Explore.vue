<template>
<div v-loading='loading' style="margin: 0 80px; height:800px;" element-loading-background="#f5f7fb">
  <el-row :gutter="40">
    <el-col :span="6" v-for="anime in animes" :key="anime.id" style="min-width: 300px; max-width: 300px" >
      <el-card :body-style="{ padding: '0px' }" style="margin-bottom:40px">
        <img :src="anime.posterUrl" class="image" height="370px">
        <div style="padding: 14px;">
          <span class="title">{{ anime.title }}</span>
          <div class="bottom clearfix">
            <time class="time">2018-06-04 11:27</time>
            <el-button type="text" class="button" @click="handleDetail(anime)">查看详情</el-button>
          </div>
        </div>
      </el-card>
    </el-col>
    <el-dialog :visible.sync="dialogVisible" v-if="curAnime">
      <anim :anime="curAnime"/>
    </el-dialog>
  </el-row>
</div>
</template>

<script>
import anim from './Anime.vue'
import info from '../utils/global.js'
import http from '../utils/http.js'

export default {
  data () {
    return {
      animes: [],
      loading: true,
      dialogVisible: false,
      curAnime: ''
    }
  },
  mounted () {
    alert(info.apiToken)
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
    async getData () {
      const res = await http.get('animation/get_list', {})
      this.animes = res.data
      console.log(this.animes)
      this.loading = false
    }
  }
}
</script>

<style>
  .title {
    max-width: 50px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  .time {
    font-size: 13px;
    color: #999;
  }

  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
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
