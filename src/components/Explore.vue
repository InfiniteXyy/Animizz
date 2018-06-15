<template>
<div v-loading='loading' style="margin: 0 80px; height:800px;" element-loading-background="#f5f7fb">
  <el-row :gutter="40">
    <el-col :span="6" v-for="anime in animes" :key="anime.id" style="min-width: 300px; max-width: 300px" >
      <el-card :body-style="{ padding: '0px' }" style="margin-bottom:40px">
        <img :src="bigImg(anime)" class="image" height="370px">
        <div style="padding: 14px;">
          <span>{{ title(anime) }}</span>
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
    this.axios.get('/api/edge/trending/anime', {params: {limit: 40}})
      .then(response => {
        this.animes = response.data.data
        this.loading = false
      })
      .catch(function (error) {
        alert(error)
      })
  },
  components: {
    anim
  },
  methods: {
    title: anime => anime.attributes.titles.ja_jp.substr(0, 11),
    bigImg: anime => anime.attributes.posterImage.original,
    smallImg: anime => anime.attributes.posterImage.small,
    rate: anime => anime.attributes.averageRating,
    handleDetail (anime) {
      this.dialogVisible = true
      this.curAnime = anime
    }
  }
}
</script>

<style>
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
