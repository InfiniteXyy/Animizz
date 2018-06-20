<template>
<div v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="50">
  <el-input type="textarea" :rows="4" placeholder="请输入内容" v-model="textarea">
  </el-input>
  <el-checkbox v-model="exceptMe" style="float: left; margin-top: 30px">隐藏自己的动态</el-checkbox>
  <el-button class="button" size="mini" @click="sendMoment()">发送</el-button>
  <el-button class="button" size="mini" type="primary" @click="reload()" style="margin-right:10px">刷新</el-button>
  <div id="momentList">
    <div class="moment" v-for="data in moments" :key="data.id">
      <div class="wrapper">
        <img class="avatar" :src="data.user.avatar">
        <div class="content">
          <b><p class="user">{{data.user.username}}</p></b>
          <p class="momentContent">{{data.content}}</p>
          <p class="time">{{formatedDate(data.time)}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'
import moment from 'moment'

export default {
  data () {
    return {
      textarea: '',
      moments: [],
      page: 0,
      busy: false,
      exceptMe: false
    }
  },
  methods: {
    formatedDate (dateValue) {
      let date = new Date(dateValue * 1000)
      return moment(date).calendar()
    },
    loadMore () {
      this.busy = true
      this.page += 1
      if (this.page >= 3) {
        this.busy = true
        return
      }
      http.post('moment/get', {page: this.page, uid: info.uid, exceptMe: this.exceptMe ? 1 : 0}).then((res) => {
        for (let i of res.data) {
          this.moments.push(i)
        }
        this.busy = false
      })
    },
    reload () {
      this.page = 0
      this.moments = []
      this.busy = false
    },
    sendMoment () {
      let postData = {
        uid: info.uid,
        api_token: info.apiToken,
        content: this.textarea
      }

      const res = http.post('moment/create', postData)
      res.then((data) => {
        this.moments.unshift({
          content: this.textarea,
          user: info.profile,
          time: data.data.time
        })
        this.textarea = ''
      }).catch((data) => {
        this.$message.error(res.msg)
      })
    }
  },
  mounted () {

  }
}
</script>

<style scoped>
.button {
  margin-top: 20px;
}

#momentList {
  margin-top: 80px;
}

.moment {
  width: 100%;
  margin-bottom: 20px;
  border-bottom: 2px solid #f5f7fb;
}

.avatar {
  width: 40px;
  height: 40px;
  margin: 20px;
  border-radius: 50%;
}

.content {
  width: 100%;
  margin-right: 50px;
}

.user {
  font-size: 13px;
  color: #343a40;
}

.time {
  font-size: 14px;
  color: #9aa0ac;
}

.momentContent {
  padding: 24px 16px;
  background: #f7f7f7;
  border-radius: 12px;
}
</style>
