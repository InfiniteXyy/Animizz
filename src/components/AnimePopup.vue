<template>
<div>
  <p>{{rate(data)}}</p>
  <el-button @click="updateStatus(2)" size='mini' type="success">看过</el-button>
  <el-button @click="updateStatus(1)" size='mini' type="info">正在</el-button>
  <el-button @click="updateStatus(0)" size='mini' type="primary">想看</el-button>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  props: ['data'],
  data () {
    return {

    }
  },
  methods: {
    rate (a) {
      return '评分: ' + (a.rate / 100 * 5).toFixed(2)
    },
    updateStatus (status) {
      http.post('user/animation', {uid: info.uid, status: status, animation_id: this.data.id}).then((res) => {
        this.$notify({
          title: '成功',
          message: res.data.content,
          type: 'success'
        })
      })
    }
  }
}
</script>
