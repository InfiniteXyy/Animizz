<template>
<el-header>
  <el-menu style="height: 60px" :default-active="activeIndex" mode="horizontal" :router="true" class="menu">
    <div class="menu-wrapper" style="float: left; pointer-events: none;">
      <img src="../assets/logo.png" height="40px">
    </div>
    <el-submenu index="explore">
      <template slot="title">浏览</template>
      <el-menu-item index="explore">首页</el-menu-item>
      <el-menu-item index="all">全部</el-menu-item>
    </el-submenu>

    <el-menu-item index="mine">我的</el-menu-item>
    <el-menu-item index="group">群组</el-menu-item>
    <div class="menu-wrapper" style="float: right">
      <el-dropdown trigger="click" @command="click_item">
        <img class="avatar" :src="info.profile.avatar">
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item command='setting'>个人设置</el-dropdown-item>
          <el-dropdown-item command='back' divided>退出登录</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <div class="menu-wrapper" style="float: right; margin: 16px 0px; padding: 0 0">
      <el-button type="info" icon="el-icon-bell" circle size="mini"></el-button>
    </div>
    <div class="menu-wrapper" style="float: right">
      <el-input v-model="search" placeholder="Search Animizz">
        <i slot="prefix" class="el-input__icon el-icon-search"></i>
      </el-input>
    </div>
  </el-menu>
  <el-dialog
  title="个人信息"
  :visible.sync="dialogVisible"
  width="40%">
  <profile></profile>
  <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">取 消</el-button>
    <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
  </span>
</el-dialog>
</el-header>

</template>

<script>
import info from '../utils/global.js'
import profileDialog from './ProfileDialog.vue'

export default {
  data () {
    return {
      activeIndex: 'explore',
      search: '',
      info: info,
      dialogVisible: false
    }
  },
  methods: {
    click_item (command) {
      switch (command) {
        case 'setting':
          this.dialogVisible = true
          break
        default:
          this.$router.push({
            path: '/login'
          })
      }
    },
    handleSelect () {

    }
  },
  components: {
    profile: profileDialog
  }
}
</script>

<style scoped>
.el-header {
  padding: 0;
  margin: 0;
}
.menu {
  padding: 0 20px;
}

.avatar {
  width: 40px;
  height: 40px;
  display: inline-block;
  border-radius: 50%;
  cursor: pointer;
}
.menu-wrapper {
  margin: 10px 0;
  padding: 0 20px;
  white-space: nowrap;
}

</style>
