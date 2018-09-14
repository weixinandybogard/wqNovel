// pages/book/book.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    dataList: [], //数据列表
    totalpage: 0, //总页数
    currentpage: 0, //当前页码
    autoid: 0, //当前自动编号
    fileName: 'book', //请求地址
    totalBook: 0
  }
  ,
  onItemClick: function (e) {
    try {
      console.log(e.currentTarget.dataset.inautoid)
      wx.navigateTo({
        url: '../novelDetail/novelDetail?inautoid=' + e.currentTarget.dataset.inautoid,
      })
    } catch (e) {
      console.error('onItemClick')
      console.error(e)
    }
  }
  ,
  onBookManage: function (e) {
    try {
      wx.navigateTo({
        url: '../bookManage/bookManage',
      })
    } catch (e) {
      console.error('onBookManage')
      console.error(e)
    }
  }
  ,

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {
      wx.setNavigationBarTitle({
        title: '书架',
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
    const self = this;
    app.util.footer(self);
  }

  ,

  /**
   * 请求网络数据
   */
  askWebData: function (e) {
    try {
      this.data.currentpage++;
      if (this.data.currentpage > this.data.totalpage) {//如果已经超出最后一页就退出
        app.util.message({
          title: '所有数据已加载'
        })
        return;
      }
      var that = this
      app.util.request({//获取书架信息
        url: 'entry/wxapp/BookTotalRecord',
        success: function (e) {
          try {
            // console.log(e.data.data)

            if (e.data.data.length == 0) {
              app.util.message({
                title: '没有数据'
              })
              return;
            }
            // //加入新的数据
            var temp = {};//初始化一个对象
            var i = 0//循环计数
            for (i = 0; i < e.data.data.length; i++) {
              // that.data.dataList.push(e.data.data[i])
              if (i % 2 == 0) {//如果是双数
                temp = {};//初始化一个数组
                temp.auto_id1 = e.data.data[i].auto_id
                temp.title1 = e.data.data[i].title
                temp.src1 = e.data.data[i].src
                temp.introduce_auto_id1 = e.data.data[i].introduce_auto_id
              } else {//单数
                temp.auto_id2 = e.data.data[i].auto_id
                temp.title2 = e.data.data[i].title
                temp.src2 = e.data.data[i].src
                temp.introduce_auto_id2 = e.data.data[i].introduce_auto_id
                that.data.dataList.push(temp)//加入一个
              }
            }
            if ((i - 1) % 2 == 0) {//如果是双数结尾就加入一个
              // console.log('fdsfdsfdsfdsfds')
              that.data.dataList.push(temp)//加入一个
            }
            // //加入新的数据

            that.setData({//刷新数据
              dataList: that.data.dataList
            })
            // console.log(that.data.dataList)
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        },

      })
    } catch (e) {
      console.error('askWebData')
      console.error(e)
    }
  }
  ,

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    try {
      this.setData({ //复原数据
        dataList: [], //数据列表
        totalpage: 0, //总页数
        currentpage: 0, //当前页码
        autoid: 0, //当前自动编号
        fileName: 'ims_we7_wxapp_books', //请求地址
        totalBook: 0
      })
      var that = this
      app.util.request({//获取书籍总本数
        url: 'entry/wxapp/BookTotalBook',
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              totalBook: e.data.data
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
      app.util.request({//获取总页数
        url: 'entry/wxapp/GetTotalPage',
        data: {
          table: this.data.fileName
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.data.totalpage = e.data.data//总页数
            that.askWebData()//请求网络数据
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
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