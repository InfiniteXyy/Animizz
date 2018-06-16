<template>
<el-container>
  <profile :user='user'></profile>
  <el-container>
    <el-header>
      <el-menu mode="horizontal" text-color="#000" active-text-color="#00a381" default-active="activity" @select="handleSelect">
        <el-menu-item index="activity">动态</el-menu-item>
        <el-menu-item index="library">库</el-menu-item>
        <el-menu-item index="myman">关注</el-menu-item>
      </el-menu>
    </el-header>
    <el-main>
      <keep-alive>
        <div :is='currentView'></div>
      </keep-alive>
    </el-main>
  </el-container>
  <div class="recommand">
  </div>
</el-container>
</template>

<script>
import activity from '@/components/Activity.vue'
import myman from '@/components/Follow.vue'
import library from '@/components/Library.vue'
import group from '@/components/Group.vue'
import profile from '@/components/Profile.vue'

export default {
  data () {
    return {
      activeName: 'first',
      user: {},
      currentView: 'activity'
    }
  },
  methods: {
    handleSelect (view) {
      this.currentView = view
    }
  },
  mounted () {

  },
  components: {
    activity,
    myman,
    library,
    group,
    profile
  }
}
</script>

<style scoped>
  .el-main {
    background-color: white;
  }

  .el-header {
    padding: 0 0;
    margin: 0 0;
  }
  .recommand {
    width: 240px;
    height: 500px;
    background: white;
    margin-left: 20px;
  }
</style>
