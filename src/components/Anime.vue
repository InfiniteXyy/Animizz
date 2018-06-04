<template>
<el-main v-loading="loading" class="container" v-if="curAnime">
  <div>
    <img :src="curAnime.attributes.coverImage.large" style="width: 100%">
    <h2>{{curAnime.attributes.titles.ja_jp}}</h2>
    <el-rate v-model="rate" disabled show-score text-color="#ff9900" allow-half>
    </el-rate>
    <el-tabs v-model="activeName">
      <el-tab-pane label="简介" name="first">{{curAnime.attributes.synopsis}}</el-tab-pane>
      <el-tab-pane label="分集" name="second">分集</el-tab-pane>
      <el-tab-pane label="声优" name="third">神优</el-tab-pane>
      <el-tab-pane label="资源" name="fourth">资源</el-tab-pane>
    </el-tabs>
  </div>
</el-main>
</template>
<script>
export default {
  data () {
    return {
      curAnime: null,
      loading: true,
      currentDate: new Date().toDateString(),
      activeName: 'first',
      rate: 0
    }
  },
  mounted () {
  },
  methods: {
    getParams () {
      // 取到路由带过来的参数
      let routerParams = this.$route.params.dataObj
      // 将数据放在当前组件的数据内
      this.curAnime = routerParams
    }
  },
  watch: {
    '$route': 'getParams'
  }
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
