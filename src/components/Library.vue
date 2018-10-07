<template>
<div>
  <h1>{{curFavourite.title}}
    <span style="float: right" id="switch" @click="dialogVisible=true">切换</span>
    <span style="float: right; margin-right: 20px" id="switch" @click="addDialogVisible=true">增加</span>
  </h1>
  <el-table :data="curFavourite.favouriteAnimation" :highlight-current-row="true">
    <el-table-column prop="animation.title" label="标题"></el-table-column>
    <el-table-column prop="operation" label="操作">
      <template slot-scope="scope">
        <el-row :gutter="20">
        <el-col :span="6">
        <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button></el-col>
        </el-row>
      </template>
    </el-table-column>
  </el-table>
  <el-row style="margin-top: 20px" :gutter="24">
    <el-col :span="6"><el-button @click="setDialogVisible = true">设置表信息</el-button></el-col>
    <el-col :span="6"><el-button type="primary" @click="loadList()">刷新</el-button></el-col>
  </el-row>
  <el-dialog title="清单" :visible.sync="dialogVisible" width="24%">
    <el-select v-model="tempFavourite" placeholder="请选择">
      <el-option v-for="item in favourList" :key="item.id" :label="item.title" :value="item.title">
      </el-option>
    </el-select>
    <span slot="footer" class="dialog-footer">
      <el-button type="primary" @click="handleSelect">确 定</el-button>
    </span>
  </el-dialog>

  <el-dialog title="设置" :visible.sync="setDialogVisible" width="30%">
    <el-form ref="listForm" :model="listForm" label-width="120px">
      <el-form-item label="表名">
        <el-input v-model="listForm.title"></el-input>
      </el-form-item>
    </el-form>
    <span slot="footer" class="dialog-footer">
        <el-button size="mini" type="primary" @click="deleteTable">删表</el-button>
        <el-button size="mini" type="error" @click="updateTable">改名</el-button>
    </span>
  </el-dialog>
  <el-dialog title="增加" :visible.sync="addDialogVisible" width="30%">
    <el-input v-model="addDialogTitle"></el-input>
    <span slot="footer" class="dialog-footer">
      <el-button type="primary" @click="addTable">增 加</el-button>
    </span>
  </el-dialog>
</div>
</template>

<script>
import http from '../utils/http.js'
import info from '../utils/global.js'

export default {
  data () {
    return {
      favourList: [],
      curFavourite: {title: '加载中...', favouriteAnimation: []},
      tempFavourite: '',
      dialogVisible: false,
      addDialogVisible: false,
      setDialogVisible: false,
      addDialogTitle: '',
      listForm: {title: ''}
    }
  },
  methods: {
    handleSelect () {
      this.dialogVisible = false
      for (let i of this.favourList) {
        if (i.title === this.tempFavourite) {
          this.curFavourite = i
          return
        }
      }
    },
    handleDelete (index, anime) {
      console.log(anime)
      http.post('favourite_animation/delete', {
        uid: info.uid,
        api_token: info.apiToken,
        id: anime.id
      }).then((res) => {
        this.loadList()
      })
    },
    getList () {
      http.get('favourite/get', {uid: info.uid}).then((res) => {
        this.favourList = res.data
        this.tempFavourite = res.data[0].title
        this.handleSelect()
      })
    },
    loadList () {
      http.get('favourite/get', {uid: info.uid}).then((res) => {
        this.favourList = res.data
        this.handleSelect()
      })
    },
    addTable () {
      http.post('favourite/create', {uid: info.uid, api_token: info.apiToken, title: this.addDialogTitle})
        .then((res) => {
          this.getList()
          this.addDialogVisible = false
        })
    },
    deleteTable () {
      http.post('favourite/delete', {
        uid: info.uid,
        api_token: info.apiToken,
        id: this.curFavourite.id
      }).then((res) => {
        if (res.code === 200) {
          this.$notify({
            title: '成功',
            message: '删除了',
            type: 'success'
          })
          this.setDialogVisible = false
          this.getList()
        }
      })
    },
    updateTable () {
      this.setDialogVisible = false
      http.post('favourite/update', {
        uid: info.uid,
        api_token: info.apiToken,
        id: this.curFavourite.id,
        title: this.listForm.title
      }).then((res) => {
        if (res.code === 200) {
          this.$notify({
            title: '成功',
            message: '修改为' + res.data.title,
            type: 'success'
          })
          this.getList()
        }
      })
    }
  },
  mounted () {
    this.getList()
  }
}
</script>
<style scoped>
.left {
  text-align: center;
  width: 100px;
  min-width: 100px;
  margin-right: 20px;
  margin-top: 20px;
}
.el-button {
  width: 100%;
  display: block;
  margin: 10px 2px;
}

#switch {
  color: #409EFF;
  cursor: pointer;
  font-size: 14px;
}

.dialog-footer {
  display: inline-block;
  padding: 20px;
  padding-top: 10px;
  text-align: left;
}

</style>
