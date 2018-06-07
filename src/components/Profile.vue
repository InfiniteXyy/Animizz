<template>
  <el-aside width="320px">
    <div class="avatar"/>
    <div style="text-align:center">
      <div class="name">{{user.username}}</div>
      <div class="status">{{user.email}}</div>
    </div>
    <div class="line"></div>
    <h1>tags</h1>
    <el-tag>标签一</el-tag>
    <el-tag type="success">标签二</el-tag>
    <el-tag type="info">标签三</el-tag>
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
  border-right: 2px solid #f9f9f9;
  height: 100%;
}
</style>
