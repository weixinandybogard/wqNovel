// wqNovel/readNovel/readNovel.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    catalogAutoId: 0, //目录自动编号
    src: '', //小说图片地址
    content: '', //具体内容
    InAutoId: '' //介绍自动编号
  },
  onPreCatalog: function (e) {
    try {
      this.data.catalogAutoId-- //累减
      this.GetReadNovelByIntroduce('-')
    } catch (e) {
      console.error('onPreCatalog')
      console.error(e)
    }
  },
  onFindCatalo: function (e) {
    try {
      wx.navigateTo({
        url: '../catalog/catalog?inautoid=' + this.data.InAutoId,
      })
    } catch (e) {
      console.error('onFindCatalo')
      console.error(e)
    }
  },
  onNextCatalog: function (e) {
    try {
      this.data.catalogAutoId++; //累加一个
      this.GetReadNovelByIntroduce("+")
    } catch (e) {
      console.error('onNextCatalog')
      console.error(e)
    }
  },
  GetReadNovelByIntroduce: function (value) {
    try {
      // this.data.catalogAutoId++;//累加一个
      var that = this
      // console.log(this.data.InAutoId)
      // console.log(this.data.catalogAutoId)
      app.util.request({
        url: 'entry/wxapp/GetReadNovelByIntroduce',
        data: {
          introduce_auto_id: this.data.InAutoId,
          catalog_auto_id: this.data.catalogAutoId
        },
        success: function (e) {
          try {
            // console.log(e)
            if (e.data.data.length > 0) {
              that.setData({
                catalogAutoId: e.data.data[0].catalog_auto_id, //目录自动编号
                src: e.data.data[0].src, //小说图片地址
                content: e.data.data[0].content, //具体内容
                InAutoId: e.data.data[0].introduce_auto_id //介绍自动编号
              })
            } else {
              app.util.message({ //提示
                title: '没有下一章了'
              })
              if (value == '+') that.data.catalogAutoId-- //复原
              if (value == '-') that.data.catalogAutoId++ //复原
            }

          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('GetReadNovelByIntroduce')
      console.error(e)
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {
      // console.log(options)
      wx.setNavigationBarTitle({
        title: '读小说',
      })

      var that = this
      if (options.catalog_auto_id != undefined) { //如果是章节列表

        if (app.globalData.userInfo != null) {//必须存在open_id
        
          app.util.request({//插入阅读历史
            url: 'entry/wxapp/InsertRecentReadRecord',
            data: {
              catalog_auto_id: options.catalog_auto_id,
              open_id: app.globalData.userInfo.openid
            },
            success: function (e) {
              try {
                // console.log(e)
              } catch (e) {
                console.error('success')
                console.error(e)
              }
            }
          })
        }


        app.util.request({ //章节获取小说内容
          url: 'entry/wxapp/GetReadNovelByCatalog',
          data: {
            catalog_auto_id: options.catalog_auto_id
          },
          success: function (e) {
            try {
              // console.log(e.data)
              that.setData({
                catalogAutoId: e.data.data[0].catalog_auto_id, //目录自动编号
                src: e.data.data[0].src, //小说图片地址
                content: e.data.data[0].content, //具体内容
                InAutoId: e.data.data[0].introduce_auto_id //介绍自动编号
              })
            } catch (e) {
              console.error('success')
              console.error(e)
            }
          }
        })
      }
    } catch (e) {
      console.error('onload')
      console.error(e)
    }
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})