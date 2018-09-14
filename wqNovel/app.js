//app.js
App({
  util: require('./utils/js/util.js'),
  onLaunch: function () {
    // 展示本地存储能力
   
      
    
  },
  globalData: {
    userInfo: null
  },
  tabBar: {
    "color": "#000",
    "selectedColor": "#0000ff",
    "borderStyle": "#1ba9ba",
    "backgroundColor": "#fff",
    "list": [
      {
        "iconPath": "../pics/goodChoose.jpg",
        "selectedIconPath": "../pics/goodChoose.jpg",
        "pagePath": "/wqNovel/goodChoose/goodChoose",
        "text": "精选",
      },
      {
        "iconPath": "../pics/divideKind.jpg",
        "selectedIconPath": "../pics/divideKind.jpg",
        "pagePath": "/wqNovel/divideKind/divideKind",
        "text": "分类",
      },
      {
        "iconPath": "../pics/book.jpg",
        "selectedIconPath": "../pics/book.jpg",
        "pagePath": "/wqNovel/book/book",
        "text": "书架",
      },
      {
        "iconPath": "../pics/my.jpg",
        "selectedIconPath": "../pics/my.jpg",
        "pagePath": "/wqNovel/my/my",
        "text": "我的",
      }
    ]
  },
  siteInfo: {
    'uniacid': '8',
    'acid': '8',
    'uniacid': '2',
    'acid': '100384',
    'version': '1.0.0',
    'siteroot': 'http://192.168.0.198/we77/app/index.php',
  }
})