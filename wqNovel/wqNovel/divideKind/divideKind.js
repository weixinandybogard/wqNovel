// pages/divideKind/divideKind.js
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    currentpage: 0, //当前页面
    totalpage: 0, //总页书来那
    autoid: 0, //当前自动编号
    oneSelect: 0, //第一列的选择
    twoSelect: 0, //第二列的选择
    threeSelect: 0, //第三列的选择
    fourSelect: 0, //第四列的选择
    dataList: [], //数据列表
    fourKind: [], //第四类型
    threeKind: [], //第三类
    twoKind: [], //第二中类型
    titlesrc: '', //标题搜搜图标
    oneKind: [] //第一类
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
  onDetailItemClick: function (e) {
    try {
      // console.log(e)
      wx.navigateTo({
        url: '../novelDetail/novelDetail?inautoid=' + e.currentTarget.dataset.autoid,
      })
    } catch (e) {
      console.error('onDetailItemClick')
      console.error(e)
    }
  },
  /**
   * 清空所有选择并选择指定的id
   */
  clearCheck: function (data, id) {
    try {
      for (var i = 0; i < data.length; i++) {
        data[i].checked = "0";
      }
      data[id].checked = "1"
    } catch (e) {
      console.error('clearCheck')
      console.error(e)
    }
  },
  /**
   * 选择单击事件
   */
  onItemClickText: function (e) {
    try {
      // console.log(e)
      // console.log(e.currentTarget.dataset.id);
      if (e.currentTarget.dataset.line == "1") {
        // console.log('执行')

        this.clearCheck(this.data.oneKind, e.currentTarget.dataset.id)
        this.setData({
          oneKind: this.data.oneKind
        })
        this.data.oneSelect = e.currentTarget.dataset.id;
      }
      if (e.currentTarget.dataset.line == "2") {
        this.clearCheck(this.data.twoKind, e.currentTarget.dataset.id)
        this.setData({
          twoKind: this.data.twoKind
        })
        this.data.twoSelect = e.currentTarget.dataset.id;
      }
      if (e.currentTarget.dataset.line == "3") {
        this.clearCheck(this.data.threeKind, e.currentTarget.dataset.id)
        this.setData({
          threeKind: this.data.threeKind
        })
        this.data.threeSelect = e.currentTarget.dataset.id;
      }
      if (e.currentTarget.dataset.line == "4") {
        this.clearCheck(this.data.fourKind, e.currentTarget.dataset.id)
        this.setData({
          fourKind: this.data.fourKind
        })
        this.data.fourSelect = e.currentTarget.dataset.id;
      }

      // console.log('执行清空')
      this.setData({
        currentpage: 0, //当前页面
        totalpage: 0, //总页书来那
        autoid: 0, //当前自动编号
        dataList: []
      })
      this.getTotalPage() //重新获取数据
    } catch (e) {
      console.error('onItemClickText')
      console.error(e)
    }
  },
  /**
   * 初始化搜索图标
   */
  initSearchPic: function () {
    try {
      var that = this
    
    } catch (e) {
      console.error('initSearchPic')
      console.error(e)
    }
  },
  /**
   * 构建数据
   */
  buildData: function (data, line) {
    try {
      for (var i = 0; i < data.length; i++) {
        data[i].thisindex = i;
      }
      // console.log(data)
      if (line == 1) { //如果是第一航就第一个
        // data[0].check = true;
        // data[1].check = false;
        // data[0].check = true
        // console.log("执行1")
        // this.data.oneKind = data
        this.setData({
          oneKind: data
        })
        this.getBookKind(2)
      }
      if (line == 2) {
        // console.log(data)
        // console.log("执行2")
        // this.data.twoKind = data
        this.setData({
          twoKind: data
        })
        this.getBookKind(3)
      }
      if (line == 3) {
        // console.log("执行3")
        // this.data.threeKind = data
        this.setData({
          threeKind: data
        })
        this.getBookKind(4)
      }
      if (line == 4) {
        // console.log("执行4")
        // this.data.fourKind = data
        this.setData({
          fourKind: data
        })
        this.getTotalPage() //获取总页数

      }
    } catch (e) {
      console.error('buildData')
      console.error(e)
    }
  },
  /**
   * 获取小说信息
   */
  getXiaoShuoInfo: function () {
    try {
      var that = this
      //判断数据是否需要加载显示
      this.data.currentpage++;
      // console.log("当前页面：" + this.data.currentpage);
      // console.log("总页数：" + this.data.totalpage)
      if (this.data.currentpage > this.data.totalpage) {
        wx.showToast({
          title: '所有数据显示',
        })
        return
      }
      //判断数据是否需要加载显示

      // var that = this;
      // console.log(this.data.oneKind)
      // console.log(this.data.oneKind[this.data.oneSelect].auto_id)
      // console.log(this.data.twoKind[this.data.twoSelect].auto_id)
      // console.log(this.data.threeKind[this.data.threeSelect].auto_id)
      // console.log(this.data.fourKind[this.data.fourSelect].auto_id)
      // console.log(this.data.autoid)
      app.util.request({ //获取小说介绍信息
        url: 'entry/wxapp/BookKindDetail',
        data: {
          lineoneautoid: this.data.oneKind[this.data.oneSelect].auto_id,
          linetwoautoid: this.data.twoKind[this.data.twoSelect].auto_id,
          linethreeautoid: this.data.threeKind[this.data.threeSelect].auto_id,
          linefourautoid: this.data.fourKind[this.data.fourSelect].auto_id,
          autoid: this.data.autoid
        },
        success: function (e) {
          // console.log(e.data)
          try {
            // app.util.message({
            //   title: 'success'
            // })

            if (e.data.data.length == 0) { //如果数据是0就退出和提示
              app.util.message({
                title: '还没有小说'
              })
              return
            }

            //加入数据
            for (var i = 0; i < e.data.data.length; i++) {
              that.data.dataList.push(e.data.data[i])
            }
            //加入数据

            that.setData({ //刷新数据
              dataList: that.data.dataList
            })

            that.data.autoid = that.data.dataList[that.data.dataList.length - 1].auto_id //保存最大自动比那好
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }

      })


    } catch (e) {
      console.error('getXiaoShuoInfo')
      console.error(e)
    }
  },
  /**
   * 获取总页数
   */
  getTotalPage: function () {
    try {
      var that = this
      app.util.request({
        url: 'entry/wxapp/GetTotalPage',
        data: {
          table: 'ims_we7_wxapp_instroduce'
        },
        method: 'get',
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.data.totalpage = e.data.data //保存总页数
            that.getXiaoShuoInfo() //获取小说信息
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('getTotalPage')
      console.error(e)
    }
  },
  /**
   * 获取书的类别
   */
  getBookKind: function (lines) {
    try {
      var that = this
      app.util.request({
        url: "entry/wxapp/BookKind",
        data: {
          line: lines
        },
        success: function (e) {
          try {
            // console.log(e.data.data)
            that.buildData(e.data.data, lines) //构建数据
          } catch (e) {
            console.error('success')
            console.error(e)
          }
        }
      })
    } catch (e) {
      console.error('getBookKind')
      console.error(e)
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    try {
      wx.setNavigationBarTitle({
        title: '分类',
      })
      this.initSearchPic()
      this.getBookKind(1)


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
    this.getXiaoShuoInfo()
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})