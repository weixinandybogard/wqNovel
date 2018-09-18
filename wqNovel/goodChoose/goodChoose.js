// pages/goodChoose/goodChoose.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    showLogin: false, //是否显示弹出登陆授权
    tuijian: [], //推荐数据
    hot: [], //热门小说
    limitTimeFree: [], //限时免费
    newBook: [], //新书速递
    finishBook: [], //完本小说
    src: '',
    luobo: [], //轮播图
    sex: '男',
    tuijianHeight: '', //推荐高度
    hotHeight: '', //推荐高度
    limitTimeFreeHeight: '', //推荐高度
    newBookHeight: '', //推荐高度
    finishBookHeight: '' //推荐高度
  }


  ,
  onLunBoClick: function (e) {
    try {
      // console.log(e)
      wx.navigateTo({
        url: '../novelDetail/novelDetail?inautoid=' + e.currentTarget.dataset.inautoid,
      })
    } catch (e) {
      console.error('onLunBoClick')
      console.error(e)
    }
  }
  ,
  onClickItem: function (e) {
    try {
      // console.log(e.currentTarget.dataset.inautoid)
      wx.navigateTo({
        url: '../novelDetail/novelDetail?inautoid=' + e.currentTarget.dataset.inautoid,
      })
    } catch (e) {
      console.error('onClickItem')
      console.error(e)
    }
  }
  ,
  onSearch: function (e) {
    try {
      wx.navigateTo({
        url: '../search/search',
      })
    } catch (e) {
      console.error('onSearch')
      console.error(e)
    }
  }
  ,
  onbindchange: function (e) {
    try {
      // console.log(e.detail.value)
      this.data.sex = e.detail.value
      //主页其他
      this.setData({
        tuijian: [], //推荐数据
        hot: [], //热门小说
        limitTimeFree: [], //限时免费
        newBook: [], //新书速递
        finishBook: [], //完本小说
      })
      this.initData()
      //主页其他
    } catch (e) {
      console.error('onbindchange')
      console.error(e)
    }
  }
  ,
  /**
   *  获取界面数据
   */
  initData: function () {
    try {
      var that = this
      app.util.request({//获取轮播数据
        url: "entry/wxapp/GoodChooseLunbo",

        success: function (e) {
          // console.log(e.data.data)
          try {
            that.setData({
              lunbo: e.data.data
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }

        },
        fail: function (e) {

        }
        ,
      })

      app.util.request({//推荐数据
        url: "entry/wxapp/TuiJian",
        data: {
          sex: this.data.sex
        },
        success: function (e) {
          try {
            // console.log(e.data)
            that.setData({
              tuijian: e.data.data
            })
            if (e.data.data.length == 0) {
              that.setData({
                tuijianHeight: 'height:60rpx;'
              })
            } else {
              that.setData({
                tuijianHeight: ''
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        },
      })

      app.util.request({//热门小说
        url: "entry/wxapp/Hot",
        data: {
          sex: this.data.sex
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              hot: e.data.data
            })
            if (e.data.data.length == 0) {
              that.setData({
                hotHeight: 'height:60rpx;'
              })
            } else {
              that.setData({
                hotHeight: ''
              })
            }
          } catch (e) {
            console.error("success")
            console.error(e)
          }
        }
      })

      app.util.request({//限时免费
        url: "entry/wxapp/limitTimeFree",
        data: {
          sex: this.data.sex
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              limitTimeFree: e.data.data
            })
            if (e.data.data.length == 0) {
              that.setData({
                limitTimeFreeHeight: 'height:60rpx;'
              })
            } else {
              that.setData({
                limitTimeFreeHeight: ''
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })

      app.util.request({//新书
        url: "entry/wxapp/NewBook",
        data: {
          sex: this.data.sex
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              newBook: e.data.data
            })
            if (e.data.data.length == 0) {
              that.setData({
                newBookHeight: 'height:60rpx;'
              })
            } else {
              that.setData({
                newBookHeight: ''
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })

      app.util.request({//完本小说
        url: "entry/wxapp/FinishBook",
        data: {
          sex: this.data.sex
        },
        success: function (e) {
          try {
            // console.log(e.data)
            that.setData({
              finishBook: e.data.data
            })
            if (e.data.data.length == 0) {
              that.setData({
                finishBookHeight: 'height:60rpx;'
              })
            } else {
              that.setData({
                finishBookHeight: ''
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error("initdata")
      console.error(e)
    }
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    // console.log(app.tabBar)

    try {
      wx.setNavigationBarTitle({
        title: '精选',
      })


      // md5.
    } catch (e) {
      console.error('onload')
      console.error(e)
    }
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

    try {
      const self = this;
      app.util.footer(self);
      app.util.getUserInfo(function (response) {

        app.globalData.userInfo = response.memberInfo

      })//获取用户信息
    } catch (e) {
      console.error('onReady')
      console.error(e)
    }


  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    try {
      var that = this
    
      // this.initData()
      this.initData()//获取初始数据
    } catch (e) {
      console.error('onshow')
      console.error(e)
    }
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