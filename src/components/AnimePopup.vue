<template>
<div>
  <p>{{rate(data)}}</p>
  <el-button :plain="isPlain(2)" :disabled="!isPlain(2)" @click="updateStatus(2)" size='mini' type="success">看过</el-button>
  <el-button :plain="isPlain(1)" :disabled="!isPlain(1)" @click="updateStatus(1)" size='mini' type="info">正在</el-button>
  <el-button :plain="isPlain(0)" :disabled="!isPlain(0)" @click="updateStatus(0)" size='mini' type="primary">想看</el-button>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  props: ['data'],
  data () {
    return {
      curStatus: -1
    }
  },
  mounted () {
    this.getStatus()
  },
  methods: {
    rate (a) {
      return '评分: ' + (a.rate).toFixed(2)
    },
    isPlain (i) {
      return this.curStatus !== i
    },
    updateStatus (status) {
      http.post('user/animation', {uid: info.uid, status: status, animation_id: this.data.id}).then((res) => {
        this.$notify({
          title: '成功',
          message: res.data.content,
          type: 'success'
        })
        this.curStatus = status
      })
    },
    getStatus () {
      http.get('user/animation', {uid: info.uid, animation_id: this.data.id}).then((res) => {
        this.curStatus = res.data
        console.log(this.curStatus)
      })
    }
  }
}
</script>
