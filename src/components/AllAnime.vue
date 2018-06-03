<template>
<div v-loading='loading'>
    <el-row :gutter="50">
        <el-col :span="6" v-for="anime in animes" :key="anime.id" style="cardimg">
            <el-card class="card" :body-style="{ padding: '0px' }">
                <img :src="bigImg(anime)" class="image" height="300px" @click="handleDetail">
                <div style="padding: 14px;">
                    <span class="word">{{ title(anime) }}</span>
                    <div class="bottom">
                        <el-tag>{{ rate(anime) }}</el-tag>
                        <span style="float: right">
                            <i style="color: #ff9900;" class="el-icon-star-off"></i>
                        </span>
                    </div>
                </div>
            </el-card>
        </el-col>
    </el-row>
</div>
</template>

<script>
export default {
  data () {
    return {
      animes: [],
      loading: true
    }
  },
  mounted () {
    this.axios.get('/api/edge/trending/anime')
      .then(response => {
        this.animes = response.data.data
        this.loading = false
      })
      .catch(function (error) {
        alert(error)
      })
  },
  methods: {
    title: anime => anime.attributes.titles.ja_jp.substr(0, 11),
    bigImg: anime => anime.attributes.posterImage.original,
    rate: anime => anime.attributes.averageRating,
    handleDetail () {
      this.$router.push({
        path: 'anime'
      })
    }
  }
}
</script>

<style>
.bottom {
    margin-top: 15px;
}
.cardimg {
    min-width: 410px;
    max-width: 210px;
}
</style>
