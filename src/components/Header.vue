<template>
<el-header>
  <el-row>
    <el-col :offset="2">
      <el-menu :default-active="activeIndex" mode="horizontal" :router="true" class="menu">
        <el-menu-item index="explore">浏览</el-menu-item>
        <el-menu-item index="mine">我的</el-menu-item>
        <el-menu-item index="setting">帮助</el-menu-item>
      </el-menu>
    </el-col>
  </el-row>
</el-header>
</template>

<script>
export default {
  data () {
    return {
      activeIndex: 'mine'
    }
  },
  methods: {
    click_item (command) {
      switch (command) {
        case 'setting':
          break
        default:
          this.$router.push({
            path: '/login'
          })
      }
    },
    handleSelect () {

    }
  }
}
</script>

<style scoped>
.menu {
  align-self: center
}

.el-menu {
  border-bottom: 0px;
}

.avatar {
  width: 2rem;
  height: 2rem;
  background-color: #00a3af;
  display: inline-block;
  vertical-align: bottom;
  border-radius: 50%;
  cursor: pointer;
}
</style>
