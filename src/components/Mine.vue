<template>
<el-container>
    <profile :user='user'></profile>
    <el-main>
    <el-tabs v-model="activeName">
        <el-tab-pane label="动态" name="first">
           <activity></activity>
        </el-tab-pane>
        <el-tab-pane label="库" name="second">
            <library></library>
        </el-tab-pane>
        <el-tab-pane label="关注" name="third">
            <myman></myman>
        </el-tab-pane>
        <el-tab-pane label="群组" name="fourth">
            <group></group>
        </el-tab-pane>
    </el-tabs>
    </el-main>
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
      user: {}
    }
  },
  methods: {

  },
  mounted () {
    this.axios.get('/animizz/user/1')
      .then(response => {
        this.user = response.data
      })
      .catch(function (error) {
        alert(error)
      })
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
