<template>
<el-main class="container" v-if="anime">
  <div>
    <div slot="header"><img :src="anime.coverUrl" v-loading="true" width="100%"></div>
    <h2>{{anime.title}}</h2>
    <div style="display: flex">
    <el-rate v-model="rate" disabled show-score text-color="#ff9900" allow-half/>
    <el-button type="mini" style="margin-left: 24px;" @click="addToList(anime)">添加到清单</el-button>
    <el-button size='mini' type="info" @click="commentDialogVisible = true; loadComments()">查看评论</el-button>
    <el-button size='mini' type="warning" @click="addCommentDialogVisible = true">评论</el-button>
    </div>
    <div style="margin-top:20px">{{anime.description}}</div>
  </div>
  <el-dialog append-to-body :visible.sync="commentDialogVisible" v-if="anime" title="评论">
    <p v-for="item in comments" :key="item.id">{{item.content}}</p>
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
      commentContent: ''
    }
  },
  methods: {
    addToList (anime) {
      console.log(anime)
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
        console.log(res.data)
      })
    },
    loadComments () {
      http.get('animation/get_comment', {animation_id: this.anime.id}).then((res) => {
        this.comments = res.data.comments
        console.log(this.comments)
      })
    }
  },
  computed: {
    rate () {
      return Number((this.anime.rate / 100 * 5).toFixed(2))
    }
  },
  props: ['anime'],
  mounted () {
    this.loadComments()
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
