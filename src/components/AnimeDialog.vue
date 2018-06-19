<template>
<el-main class="container" v-if="anime">
  <div>
    <div slot="header"><img :src="anime.coverUrl" v-loading="true" width="100%"></div>
    <h2>{{anime.title}}</h2>
    <div style="display: flex">
    <el-rate v-model="rate" disabled show-score text-color="#ff9900" allow-half/>
    <el-button type="mini" style="margin-left: 24px;" @click="addToList(anime)">添加到清单</el-button>
    </div>
    <div style="margin-top:20px">{{anime.description}}</div>
  </div>
</el-main>
</template>
<script>
// import info from '../utils/global.js'

export default {
  data () {
    return {
      currentDate: new Date().toDateString(),
      activeName: 'first',
      imageSrc: ''
    }
  },
  methods: {
    addToList (anime) {
      console.log(anime)
    }
  },
  computed: {
    rate () {
      return Number((this.anime.rate / 100 * 5).toFixed(2))
    }
  },
  props: ['anime']
}
</script>

<style>
.button {
  padding: 0;
  float: right;
}

.time {
  font-size: 13px;
  color: #999;
}

.image {
  width: 100%;
  display: block;
}

.card {
  margin-bottom: 30px
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
