<template>
<el-main>
    <el-tabs v-model="activeName">
        <el-tab-pane label="任务单" name="first">
            <tasks></tasks>
        </el-tab-pane>
        <el-tab-pane label="我的关注" name="second">
            <myman></myman>
        </el-tab-pane>
        <el-tab-pane label="阅读历史" name="third">
            <history></history>
        </el-tab-pane>
    </el-tabs>
</el-main>
</template>

<script>
import tasks from '@/components/Tasks.vue'
import myman from '@/components/Follow.vue'
import history from '@/components/History.vue'

export default {
  data () {
    return {
      activeName: 'first'
    }
  },
  methods: {

  },
  components: {
    tasks,
    myman,
    history
  }
}
</script>

<style>

</style>
