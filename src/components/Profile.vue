<template>
<el-aside width="320px">
  <img class="avatar" :src="profile.avatar" />
  <div style="text-align:center">
    <div class="name">{{profile.username}}</div>
    <div class="status">{{profile.status}}</div>
  </div>
  <div class="line"></div>
  <div style="text-align:center; margin-top: 40px;">
    <h1>我的标签</h1>
    <el-tag :type="tag.type" :key="tag.value" v-for="tag in dynamicTags" closable :disable-transitions="false" @close="handleClose(tag)">{{tag.value}}</el-tag>
    <el-input class="input-new-tag" v-if="inputVisible" v-model="inputValue" ref="saveTagInput" size="small" @keyup.enter.native="handleInputConfirm"
      @blur="handleInputConfirm">
    </el-input>
    <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Tag</el-button>
  </div>
</el-aside>
</template>

<script>
import info from '../utils/global.js'
import http from '../utils/http.js'

export default {
  props: ['user'],
  data () {
    return {
      dynamicTags: [],
      profile: info.profile,
      inputVisible: false,
      inputValue: ''
    }
  },
  mounted () {
    http.get('user/tag/get', {uid: info.uid}).then((res) => {
      for (let i of res.data) {
        this.dynamicTags.push(this.renderTag(i.tag))
      }
    })
  },
  methods: {
    handleClose (tag) {
      this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1)
      let postParam = {
        uid: info.uid,
        api_token: info.apiToken,
        tag: tag.value
      }

      http.post('user/tag/delete', postParam).then((res) => {
        this.$notify({
          title: '成功',
          message: '删除了一个TAG',
          type: 'success'
        })
      })
    },
    showInput () {
      this.inputVisible = true
      this.$nextTick(_ => {
        this.$refs.saveTagInput.$refs.input.focus()
      })
    },
    renderTag (content) {
      let type = ''
      switch (content.hashCode() % 5) {
        case 0:
          type = ''
          break
        case 1:
          type = 'success'
          break
        case 2:
          type = 'info'
          break
        case 3:
          type = 'warning'
          break
        case 4:
          type = 'danger'
          break
      }
      return {
        type: type,
        value: content
      }
    },
    handleInputConfirm () {
      let inputValue = this.inputValue
      if (this.dynamicTags.indexOf(inputValue) !== -1) {
        this.$message.error('该标签已经加入了')
      } else if (inputValue) {
        this.dynamicTags.push(this.renderTag(inputValue))
        let postParam = {
          uid: info.uid,
          api_token: info.apiToken,
          tag: inputValue
        }

        http.post('user/tag/create', postParam).then((res) => {
          this.$notify({
            title: '成功',
            message: '增加了一个TAG',
            type: 'success'
          })
        })
      }
      this.inputVisible = false
      this.inputValue = ''
    }
  }
}
</script>

<style scoped>
.avatar {
  width: 120px;
  height: 120px;
  border: 1px solid #f1f1f1;
  display: block;
  margin: auto;
  margin-top: 55px;
  margin-bottom: 16px;
  border-radius: 50%;
}

.name {
  font-size: 20px;
  color: #111111;
}

.status {
  font-size: 18px;
  color: #9B9B9B;
}

.line {
  margin-top: 30px;
  background-color: #f5f7fb;
  height: 16px;
  width: 100%;
}

.el-tag+.el-tag {
  margin-left: 10px;
  margin-bottom: 10px;
}

.button-new-tag {
  margin-left: 10px;
  height: 32px;
  line-height: 30px;
  padding-top: 0;
  padding-bottom: 0;
}

.input-new-tag {
  width: 90px;
  margin-left: 10px;
  vertical-align: bottom;
}

.el-aside {
  background-color: white;
  height: 100%;
  padding-bottom: 55px;
  margin-right: 20px;
}
</style>
