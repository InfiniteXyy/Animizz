## API

### 说明
1. 所有数据返回格式使用Json
1. 使用RESTful风格设计API
1. 中文使用UTF-8编码

### API 访问说明
所有访问地址为 `http://api.infinitex.cn/v1/...`

### 用户 API
**得到某个指定的用户**
GET `http://api.infinitex.cn/v1/user/100001`

```json
{
    "id": 100001,
    "email": "727160222@qq.com",
    "name": "infiniteXyy",
    "avatar": "https://www.infinitex.cn/icon/12345.png",
    "relation": "friend", // 和当前用户的关系
    "created": "2018-05-30 21:12:47",
    "favor_anim": [
        {},{}
    ], // 喜欢的动画
    "sub_user": [
        {"id": 100002}
    ], // 关注的用户
    "loc_name": "北京",
    "status": "I love My Hero Academia", // 个性签名
    "tags": ["child", "adventrue"]
}
```
**搜索用户**
GET `http://api.infinitex.cn/v1/user?name=xyy`
```json
{
    "count": "10",
    "users": [
        {}, {}
    ]
}
```
**注册用户**
POST `http://api.infinitex.cn/v1/user/`
```json
{
    "email": "727160222@qq.com",
    "name": "infiniteXyy",
    "password": "12345"
}
```
return
```json
{
    "status": "success" // success|exsits
}
```
**修改用户**
PUT `http://api.infinitex.cn/v1/user/100001`

### 期望单 API
GET `http://api.infinitex.cn/v1/list/12345`
```json
{
    "id": "12345",
    "userid": "100001",
    "username": "infiniteXyy",
    "cover": "https://www.infinitex.cn/covers/bigcover.png",
    "animations": [
        {},{}
    ],
    "created": "2018-05-30 21:12:47",
    "introduction": "贪玩蓝月",
}
```

### 动漫API
GET `http://api.infinitex.cn/v1/animation/1`
```json
{
    "id": "1",
    "title": "我的英雄学院",
    "rate": "9.8",
    "cover": "https://media.kitsu.io/anime/cover_images/1/large.jpg?1416336000",
    "introduction": "...",
}
```

### 动态API
GET `http://api.infinitex.cn/v1/moment?limit=1&offset=0`

```json
{
    "data": [
      {
        "username": "xyy",
        "content": "今天真开心",
        "time": "2018-05-30 21:12:47"
      }
    ]
}
```
### CV API
GET `http://api.infinitex.cn/v1/moment?limit=1&offset=0`

```json
{
    "data": [
      {
        "username": "xyy",
        "content": "今天真开心",
        "time": "2018-05-30 21:12:47",
        "like": 10
      }
    ]
}
```
### 剧集 API
GET `http://http://api.infinitex.cn/v1/animation/episode/1`

```json
{
    "rate": 10.0,
    "comments": [{
      "username": "xyy",
      "content": "这集真好看",
      "time": "2018-05-30 21:12:47",
      "like": 1
    }]
}
```

### CV API
GET `http://api.infinitex.cn/v1/cv/1`

```json
{
    "name": "村上春树",
    "like": "10",
    "views": "123",
    "animations": [
      {
        "name": "我的英雄学院",
        "character": "杂毛A"
      }
    ]
}
```

