// wqNovel/search/search.js
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
    fileName: 'search', //请求地址
    src: '',
    searchvalue: '' //搜索内容
  }
  ,
  onItemClick: function (e) {
    try {
      // console.log(e.currentTarget.dataset.autoid)
      wx.navigateTo({
        url: '../novelDetail/novelDetail?inautoid=' + e.currentTarget.dataset.autoid,
      })
    } catch (e) {
      console.error('onItemClick')
      console.error(e)
    }
  }
  ,
  onInput: function (e) {
    try {
      // console.log(e.detail.value);
      this.data.searchvalue = e.detail.value;
    } catch (e) {
      console.error('onInput')
      console.error(e)
    }
  }
  ,
  onSearch: function (e) {
    try {
      if (this.data.searchvalue.trim() == '') {//判断搜索内容不能空
        app.util.message({
          title: '搜索内容不能空'
        })
        return
      }
      this.setData({
        dataList: [], //数据列表
        totalpage: 0, //总页数
        currentpage: 0, //当前页码
        autoid: 0, //当前自动编号
      })
      var that = this
      app.util.request({//搜uo
        url: 'entry/wxapp/Search',
        data: {
          value: this.data.searchvalue
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.setData({
              dataList: e.data.data
            })
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
      // util.getTotalPage('xiaoshuoIntroduce', this)
    } catch (e) {
      console.error('onSearch')
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
        title: '搜索',
      })
      var that = this
      app.util.request({
        url: 'entry/wxapp/GetSou',
        success: function (e) {
          try {
            // console.log(e.data)
            that.setData({
              src: e.data
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