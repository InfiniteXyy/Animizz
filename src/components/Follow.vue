<template>
<div>
  <h1>我的关注<el-button type="mini" style="margin-left: 10px" @click="loadFollowings">刷新</el-button></h1>
  <div class="content" v-for="user in followings" :key="user.following_id">
    <img class="avatar" :src="user.toUser.avatar">
    <b><p class="username">{{user.toUser.username}}</p></b>
    <p class="status">{{status(user.toUser.status)}}</p>
    <span id="cancelBtn"><b>取消关注</b></span>
  </div>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  data () {
    return {
      followings: []
    }
  },
  methods: {
    loadFollowings () {
      http.get('user/followings', {uid: info.uid}).then((res) => {
        this.followings = res.data
      })
    },
    status (data) {
      if (data === '') {
        return '该用户没有设置个性签名'
      }
      return '“' + data + '”'
    }
  },
  mounted () {
    this.loadFollowings()
  }
}
</script>

<style scoped>
.avatar {
  width: 40px;
  height: 40px;
  margin: 20px;
  border-radius: 50%;
}
.content {
  display: flex;
  height: 100px;
  margin-bottom: 10px;
  background: #f6f6f6;
  border-radius: 10px;
}

.username {
  font-size: 17px;
}

.status {
  margin: 20px;
}

#cancelBtn {
  float: right;
  font-size: 12px;
  margin: 20px;
  color: #F56C6C;
  cursor: pointer;
}
</style>
