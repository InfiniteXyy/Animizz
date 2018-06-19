<template>
<div>
  <p>{{rate(data)}}</p>
  <el-button size='mini' type="success">已经看过</el-button>
  <el-button size='mini' type="primary">想看</el-button>
  <el-button size='mini' type="info" @click="showComment(anime)">查看评论</el-button>
</div>
</template>

<script>
export default {
  props: ['data'],
  methods: {
    rate (a) {
      return '评分: ' + (a.rate / 100 * 5).toFixed(2)
    }
  }
}
</script>
