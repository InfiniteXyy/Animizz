<template>
<el-container>
  <profile :user='user'></profile>
  <el-container>
    <el-header>
      <el-menu mode="horizontal" text-color="#000" active-text-color="#00a381" default-active="activity" @select="handleSelect">
        <el-menu-item index="activity">动态</el-menu-item>
        <el-menu-item index="library">清单</el-menu-item>
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
    <h1 style="margin:16px">用户列表</h1>
    <div v-for="single in userList" :key="single.id" style="height: 80px">
      <img class="avatar" @click="follow(single)" :src="single.avatar">
      <b class="username"><span>{{single.username}}</span></b>
    </div>
  </div>
</el-container>
</template>

<script>
import activity from '@/components/Activity.vue'
import myman from '@/components/Follow.vue'
import library from '@/components/Library.vue'
import group from '@/components/Group.vue'
import profile from '@/components/Profile.vue'
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  data () {
    return {
      activeName: 'first',
      user: {},
      userList: [],
      currentView: 'activity'
    }
  },
  methods: {
    handleSelect (view) {
      this.currentView = view
    },
    loadUser () {
      http.get('user/all', {}).then((res) => {
        this.userList = res.data
      })
    },
    follow (single) {
      http.post('user/follow', {
        uid: info.uid,
        api_token: info.apiToken,
        following_id: single.uid
      }).then((res) => {
        this.$message({ message: res.msg })
      })
    }
  },
  mounted () {
    this.loadUser()
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

  .avatar {
    cursor: pointer;
    width: 40px;
    height: 40px;
    margin-top: 20px;
    margin: 0 16px;
    border-radius: 50%;
  }

  .username {
    font-size: 17px;
    display: flex;
    float: right;
    margin-top: 15px;
    margin-right: 50px;
  }
</style>
