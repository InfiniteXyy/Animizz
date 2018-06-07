<template>
  <el-aside width="320px">
    <div class="avatar"/>
    <div style="text-align:center">
      <div class="name">{{user.username}}</div>
      <div class="status">{{user.email}}</div>
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
export default {
  props: ['user']
}
</script>

<style scoped>
.avatar {
  width: 120px;
  height: 120px;
  background-size: cover;
  background-position: top center;
  border: 1px solid  #f1f1f1;
  margin:auto;
  margin-top: 55px;
  margin-bottom: 16px;
  background-image: url(http://www.infinitex.cn/assets/avatar.png);
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
  background-color: #f9f9f9;
  height: 2px;
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
