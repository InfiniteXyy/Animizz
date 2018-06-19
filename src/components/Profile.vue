<template>
  <el-aside width="320px">
    <img class="avatar" :src="profile.avatar"/>
    <div style="text-align:center">
      <div class="name">{{profile.username}}</div>
      <div class="status">{{profile.status}}</div>
    </div>
    <div class="line"></div>
    <div style="text-align:center; margin-top: 40px;">
    <el-tag>日漫</el-tag>
    <el-tag type="success">日剧</el-tag>
    <el-tag type="info">汉堡</el-tag>
    </div>
  </el-aside>
</template>

<script>
import info from '../utils/global.js'

export default {
  props: ['user'],
  data () {
    return {
      profile: info.profile
    }
  },
  mounted () {
    console.log(info.profile)
  }
}
</script>

<style scoped>
.avatar {
  width: 120px;
  height: 120px;
  border: 1px solid  #f1f1f1;
  display: block;
  margin:auto;
  margin-top: 55px;
  margin-bottom: 16px;
  border-radius: 50%;
}

.name {
  font-size: 20px;
  color: #111111;
}

.status {
  font-size:18px;
  color: #9B9B9B;
}

.line {
  margin-top: 30px;
  background-color: #f5f7fb;
  height: 16px;
  width: 100%;
}

.el-tag {
  margin-right: 10px;
}

.el-aside {
  background-color: white;
  height: 100%;
  padding-bottom: 55px;
  margin-right: 20px;
}
</style>
