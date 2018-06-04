<template>
<div v-loading='loading'>
    <el-row :gutter="20">
        <el-col :span="6" v-for="anime in animes" :key="anime.id">
              <img :src="bigImg(anime)" @click="handleDetail(anime)" class="imgbutton" height="500px"/>
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
    handleDetail (anime) {
      this.$router.push({
        path: '/animation',
        params: {
          name: 'anime',
          dataObj: anime
        }
      })
    }
  }
}
</script>

<style>
.card {
  margin-bottom: 30px;
  display: block;
}
.imgbutton {
  cursor: pointer;
}
</style>
