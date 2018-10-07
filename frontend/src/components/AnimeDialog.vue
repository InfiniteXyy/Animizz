<template>
<el-main class="container" v-if="anime">
  <div>
    <div slot="header"><img :src="anime.coverUrl" v-loading="true" width="100%"></div>
    <h2>{{anime.title}}</h2>
    <div style="display: flex">
    <el-rate v-model="rate" disabled show-score text-color="#ff9900" allow-half/>
    <el-dropdown trigger="click" style="margin-right: 10px" @command="handleAdd">
    <el-button type="mini" style="margin-left: 24px;">添加到清单</el-button>
    <el-dropdown-menu slot="dropdown">
      <el-dropdown-item v-for="item in lists" :key="item.id" :command="item.id">{{item.title}}</el-dropdown-item>
    </el-dropdown-menu>
    </el-dropdown>
    <el-button size='mini' type="info" @click="commentDialogVisible = true; loadComments()">查看评论</el-button>
    <el-button size='mini' type="warning" @click="addCommentDialogVisible = true">评论</el-button>
    </div>
    <div style="margin-top:20px">{{anime.description}}</div>
  </div>
  <el-dialog append-to-body :visible.sync="commentDialogVisible" v-if="anime" title="评论">
      <el-table :data="comments" style="width: 100%">
      <el-table-column prop="user.username" label="用户" width="130px"> </el-table-column>
      <el-table-column prop="content" label="内容"> </el-table-column>
      <el-table-column prop="rate" label="评分"> </el-table-column>
    </el-table>
  </el-dialog>
  <el-dialog append-to-body :visible.sync="addCommentDialogVisible" v-if="anime" title="发表评论">
    <div>
      <el-rate
        v-model="rateValue"
        show-score
        score-template="{value}"
        text-color="#ff9900"
        :colors="['#99A9BF', '#F7BA2A', '#FF9900']">
      </el-rate>
      <el-input style="margin-top:30px"
        type="textarea"
        :rows="3"
        placeholder="请输入内容"
        v-model="commentContent">
      </el-input>
      <el-button style="margin-top:30px" type="primary" @click="sendComment()">发 送</el-button>
    </div>

  </el-dialog>
</el-main>
</template>
<script>
import info from '../utils/global.js'
import http from '../utils/http.js'

export default {
  data () {
    return {
      currentDate: new Date().toDateString(),
      activeName: 'first',
      comments: [],
      imageSrc: '',
      commentDialogVisible: false,
      addCommentDialogVisible: false,
      rateValue: 0,
      commentContent: '',
      lists: []
    }
  },
  methods: {
    handleAdd (command) {
      http.post('favourite_animation/create', {
        favourite_id: command,
        animation_id: this.anime.id
      }).then((res) => {
        this.$message(res.msg)
      })
    },
    addToList (anime) {

    },
    sendComment () {
      let postParam = {
        animation_id: this.anime.id,
        content: this.commentContent,
        rate: this.rateValue,
        uid: info.uid,
        api_token: info.apiToken
      }
      http.post('animation/add_comment', postParam).then((res) => {
        this.$notify({
          title: res.code === 200 ? '成功' : '失败',
          message: res.msg,
          type: res.code === 200 ? 'success' : 'error'
        })
      })
    },
    loadComments () {
      http.get('animation/get_comment', {animation_id: this.anime.id}).then((res) => {
        this.comments = res.data.comments
      })
    },
    loadLists () {
      http.get('favourite/get', {uid: info.uid}).then((res) => {
        this.lists = res.data
      })
    }
  },
  computed: {
    rate () {
      return Number((this.anime.rate).toFixed(2))
    }
  },
  props: ['anime'],
  mounted () {
    this.loadComments()
    this.loadLists()
  }
}
</script>

<style>
.button {
  padding: 0;
  float: right;
}

.time {
  font-size: 13px;
  color: #999;
}

.image {
  width: 100%;
  display: block;
}

.card {
  margin-bottom: 30px
}

.clearfix:before,
.clearfix:after {
  display: table;
  content: "";
}

.clearfix:after {
  clear: both
}
</style>
