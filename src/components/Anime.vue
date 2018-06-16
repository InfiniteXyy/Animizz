<template>
<el-main class="container" v-if="anime">
  <div>
    <div slot="header"><img :src="anime.coverUrl" v-loading="true" width="100%"></div>
    <h2>{{anime.title}}</h2>
    <el-rate v-model="rate" disabled show-score text-color="#ff9900" allow-half>
    </el-rate>
    <el-tabs v-model="activeName">
      <el-tab-pane label="简介" name="first">{{anime.description}}</el-tab-pane>
      <el-tab-pane label="分集" name="second">分集</el-tab-pane>
      <el-tab-pane label="声优" name="third">声优</el-tab-pane>
      <el-tab-pane label="资源" name="fourth">资源</el-tab-pane>
    </el-tabs>
  </div>
</el-main>
</template>
<script>
export default {
  data () {
    return {
      currentDate: new Date().toDateString(),
      activeName: 'first',
      imageSrc: ''
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
