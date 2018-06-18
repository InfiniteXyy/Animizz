<template>
<div>
  <el-input type="textarea" :rows="4" placeholder="请输入内容" v-model="textarea">
  </el-input>
  <el-button class="button" size="mini" @click="handleSend">发送</el-button>
  <div id="momentList">
    <div class="moment" v-for="data in moments" :key="data.id">
      <div class="wrapper">
        <div class="avatar">
        </div>
        <div class="content">
          {{data.content}}
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
      moments: []
    }
  },
  methods: {
    handleSend () {
      this.moments.unshift({
        content: this.textarea,
        time: new Date()
      })
      this.sendMoment()
      this.textarea = ''
    },
    formatedDate (dateValue) {
      let date = new Date(dateValue * 1000)
      console.log(dateValue)

      return moment(date).calendar()
    },
    async sendMoment () {
      let postData = {
        uid: info.uid,
        api_token: info.apiToken,
        content: this.textarea
      }
      await http.post('moment/create', postData)
    },
    async getMoments () {
      const res = await http.post('moment/get', {})
      for (let i of res.data) {
        this.moments.unshift(i)
      }
    }
  },
  mounted () {
    this.getMoments()
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
  background-size: cover;
  background-position: top center;
  background-image: url(http://www.infinitex.cn/assets/avatar.png);
  display: inline-block;
  border-radius: 50%;
}

.content {
  margin-top: 30px;
  width: 100%;
}

.time {
  font-size: 14px;
  color: #9aa0ac;
}
</style>
