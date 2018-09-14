// wqNovel/novelDetail/novelDetail.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    updateData: '', //最近更新时间
    introduce_auto_id: 0, //简介编号
    src: '', //图片地址
    bookName: '', //书名
    author: '', //作者
    status: '', //状态
    readCount: 0, //阅读次数
    des: '', //描述
    is_need_member: "否",//是否需要会员
    need_bi: 0,//需要的书币数量
    guessList: [] //猜你喜欢
  }

  ,
  onAddBook: function (e) {
    try {
      app.util.request({
        url: 'entry/wxapp/AddBook',
        data: {
          introduce_auto_id: this.data.introduce_auto_id
        },
        success: function (e) {
          try {
            // console.log(e.data)
            if (e.data.message.indexOf('已经存在') >= 0) {
              app.util.message({
                title: '之前加入过了'
              })
            } else {
              app.util.message({
                title: '加入成功.'
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('onAddBook')
      console.error(e)
    }
  }
  ,
  /**
   * 读的网络请求
   */
  readRequest: function () {
    try {
      app.util.request({//获取章节id
        url: 'entry/wxapp/GetLaticeCatlogId',
        data: {
          introduce_auto_id: this.data.introduce_auto_id
        },
        success: function (e) {
          try {
            // console.log(e.data.data[0].catalog_auto_id)
            if (e.data.data.length > 0) {//如果存在最近阅读记录
              wx.navigateTo({
                url: '../readNovel/readNovel?catalog_auto_id=' + e.data.data[0].catalog_auto_id,
              })
            } else {//如果不存在最近阅读
              // console.log(this.data.introduce_auto_id)
              app.util.request({//获取这个小说第一章
                url: 'entry/wxapp/Catalog',
                data: {
                  introduce_auto_id: this.data.introduce_auto_id
                },
                success: function (e) {
                  try {
                    // console.log('aaa')
                    // console.log(e)
                    wx.navigateTo({
                      url: '../readNovel/readNovel?catalog_auto_id=' + e.data.data[0].auto_id,
                    })
                  } catch (e) {
                    console.error('success')
                    console.error(e)
                  }
                }
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('readrequest')
      console.error(e)
    }
  }
  ,


  onRead: function () {
    try {
      var that = this
      app.util.request({//查看是否有权限读
        url: 'entry/wxapp/IsHasRightToRead',
        data: {
          introduce_auto_id: this.data.introduce_auto_id
        },
        success: function (e) {
          try {
            // console.log(e)
            if (e.data.message.indexOf('币更新成功') >= 0) {
              that.readRequest()//读取请求
            } else {
              app.util.message({
                title: e.data.message
              })
            }
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('onRead')
      console.error(e)
    }
  }
  ,

  /**目录分类按钮 */
  onFindCatalog: function (e) {
    try {
      // console.log(e)
      // wx.navigateTo({
      //   url: '../catalog/catalog?inautoid=' + this.data.InAutoId,
      // })
      wx.navigateTo({
        url: '../catalog/catalog?inautoid=' + this.data.introduce_auto_id,
      })
    } catch (e) {
      console.error('onFindCatalog')
      console.error(e)
    }
  }
  ,
  onGuessItemClick: function (e) {
    try {
      console.log(e)
      wx.redirectTo({
        url: './novelDetail?inautoid=' + e.currentTarget.dataset.inautoid,
      })
    } catch (e) {
      console.error('onGuessItemClick')
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
        title: '小说明细',
      })
      var that = this
      app.util.request({ //获取小说详细信息
        url: 'entry/wxapp/NovelDetail',
        data: {
          introduce_auto_id: options.inautoid
        },
        success: function (e) {
          try {
            // console.log(e.data.data[0])

            //是否需要会员
            var member_is = ''
            if (e.data.data[0].is_member_read == 0) {
              member_is = '否'
            } else {
              member_is = '是'
            }
            //是否需要会员

            that.setData({
              introduce_auto_id: e.data.data[0].introduce_auto_id, //简介编号
              src: e.data.data[0].src, //图片地址
              bookName: e.data.data[0].book_name, //书名
              author: e.data.data[0].author, //作者
              status: e.data.data[0].status, //状态
              readCount: e.data.data[0].read_count, //阅读次数
              des: e.data.data[0].des, //描述
              is_need_member: member_is,//是否需要会员 
              need_bi: e.data.data[0].need_bi//需要的书币数量
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })

      app.util.request({ //获取最近一次更新时间
        url: 'entry/wxapp/LastistComeTime',
        success: function (e) {
          try {
            // console.log(e.data.data[0].come_time)
            that.setData({
              updateData: e.data.data[0].come_time
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })

      app.util.request({ //猜你喜欢
        url: 'entry/wxapp/GuessLike',
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              guessList: e.data.data
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })

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