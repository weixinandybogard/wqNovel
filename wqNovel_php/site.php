<?php
/**
 * 微擎小程序模块示例模块微站定义
 *
 * @author 微擎团队
 * @url http://s.we7.cc
 */
defined ( 'IN_IA' ) or exit ( 'Access Denied' );
class WqNovelModuleSite extends WeModuleSite {
	const LUNBO = 'ims_we7_wxapp_lunbo'; // 轮播图数据
	const TUIJIAN = 'ims_we7_wxapp_tuijian'; // 精品推荐数据
	const HOT = 'ims_we7_wxapp_hot'; // 热门数据
	const LIMITTIMEFREE = 'ims_we7_wxapp_limittimefree'; // 限时免费
	const NEWBOOK = 'ims_we7_wxapp_newbook'; // 新书
	const FINISHIBOOK = 'ims_we7_wxapp_finishbook'; // 完本小说
	const BOOKKIND = 'ims_we7_wxapp_bookkind'; // 书籍分类
	const INTRODUCE = 'ims_we7_wxapp_instroduce'; // 书籍介绍
	const BOOKS = 'ims_we7_wxapp_books'; // 书架上的书籍
	const RECHARGEKIND = 'ims_we7_wxapp_rechargekind'; // 书币记录
	const ADDMONEYRECORD = 'ims_we7_wxapp_addmoneyrecord'; // 充值记录
	const BUYRECORD = 'ims_we7_wxapp_buyrecord'; // 购买记录
	const RECENTREADRECORD = 'ims_we7_wxapp_recentreadrecord'; // 最近阅读
	const CONTACTUS = 'ims_we7_wxapp_contactus'; // 联系我们
	const MEMBERKIND = 'ims_we7_wxapp_memberkind'; // 会员日
	const MEMBERMEMO = 'ims_we7_wxapp_membermemo'; // 会员说明
	const RECHARGEMEMO = 'ims_we7_wxapp_rechargememo'; // 充值说明
	const NOVELDETAIL = 'ims_we7_wxapp_noveldetail'; // 小说明细
	const GUESSLIKE = 'ims_we7_wxapp_guesslike'; // 猜你喜欢
	const CATALOG = 'ims_we7_wxapp_catalog'; // 章节目录
	const READNOVEL = 'ims_we7_wxapp_readnovel'; // 读小说
	const MEMBERINFO = 'ims_we7_wxapp_memberinfo'; // 会员信息
	public function doWebList() {
		// 这个操作被定义用来呈现 管理中心导航菜单
	}
	private function get_total_page($table) {
		// 获取总页数
		$total_page = 0;
		if ($total_page == 0) { // 如果总数是0
			$data = pdo_getall ( $table, array (), array (
					'count(*)' 
			), array (), array () );
			
			// 计算总页数
			$totalRecord = $data [0] ['count(*)'];
			$total_page = ( int ) ($totalRecord / 20);
			if ($total_page % 20 != 0 || $totalRecord < 20) {
				$total_page ++; //
			}
			// print $total_page;
		}
		
		return $total_page;
		
		// 获取总页数
	}
	
	/**
	 * 充值记录
	 */
	public function doWebAddmoneyrecord() {
		global $_GPC;
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::ADDMONEYRECORD );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		// print_r($_GPC ['direct']=='');
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// 根据不通页码显示或隐藏按钮
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::ADDMONEYRECORD, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'add_money_by_reocrd' );
	}
	/**
	 * 执行删除操作
	 */
	public function doWebAddmoneyrecordform() {
		global $_GPC;
		// print "Fdsfdsfds";
		// print_r($_GPC);
		// 删除选择的记录
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::ADDMONEYRECORD, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		// print_r("Fdsfds");
		// 删除选择的记录
		$this->doWebAddmoneyrecord (); // 刷新充值记录
	}
	public function doWebbookkind() {
		global $_GPC;
		// exit();
		// print_r("ffff");
		
		// print_r($_GPC['kind']);
		// exit();
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '分类列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::BOOKKIND );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::BOOKKIND, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'book_kind' );
	}
	/**
	 * 加入新的类型
	 */
	public function doWebbookkindadd() {
		global $_GPC;
		// 判断获取排序号
		$order_line = 0;
		if (trim ( $_GPC ['row_order'] ) != '') {
			$order_line = trim ( $_GPC ['row_order'] );
		}
		// 判断获取排序号
		
		$insert = pdo_insert ( $this::BOOKKIND, array (
				'book_kind' => $_GPC ['book_kind'],
				'line' => $_GPC ['row_num'],
				'order_line' => $order_line 
		) ); // 插入记录
		$this->doWebbookkind (); // 刷新充值记录
	}
	
	/**
	 * 删除书类别
	 */
	public function doWebbookkindDel() {
		global $_GPC;
		// print "Fdsfdsfds";
		// print_r($_GPC);
		// 删除选择的记录
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::BOOKKIND, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		// print_r("Fdsfds");
		// 删除选择的记录
		$this->doWebbookkind (); // 刷新充值记录
	}
	
	/**
	 * 书架
	 */
	public function doWebBooks() {
		global $_GPC;
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::BOOKS );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		
		$offset = ($current_page - 1) * 20;
		
		$data = pdo_getall ( $this::BOOKS, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		include $this->template ( 'books' );
	}
	
	/**
	 * 删除书架书籍
	 */
	public function doWebbooksDel() {
		global $_GPC;
		// print "Fdsfdsfds";
		// print_r($_GPC);
		// 删除选择的记录
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::BOOKS, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebBooks ();
		// include $this->template('books');
	}
	
	/**
	 * 消费记录
	 */
	public function doWebbuyrecord() {
		global $_GPC;
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::BUYRECORD );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		
		$offset = ($current_page - 1) * 20;
		
		$data = pdo_getall ( $this::BUYRECORD, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		include $this->template ( 'buy_record' );
	}
	
	/**
	 * 删除消费记录
	 */
	public function doWebbuyrecordDel() {
		global $_GPC;
		// print "Fdsfdsfds";
		// print_r($_GPC);
		// 删除选择的记录
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::BUYRECORD, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebbuyrecord ();
		// include $this->template('books');
	}
	
	/**
	 * 章节目录
	 */
	public function doWebCatalog() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '章列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::CATALOG );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::CATALOG, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'catalog' );
	}
	
	/**
	 * 获取最近简介记录
	 */
	public function doWebCatalogGetIntroduce() {
		// print "1,2,3,4,5";
		$data = pdo_getall ( $this::INTRODUCE, array (), array (), array (), 'auto_id desc', '20' );
		exit ( json_encode ( $data ) );
		// exit();
	}
	
	/**
	 * 检查输入的简介编号是否存在
	 */
	public function doWebCatalogCheckIntroduce() {
		global $_GPC;
		$data = pdo_getall ( $this::INTRODUCE, 'auto_id=' . $_GPC ['introduce_auto_id'] );
		
		// 返回查找到的标题
		if (count ( $data ) > 0) {
			print $data [0] ['title'];
		} else {
			print '';
		}
		// 返回查找到的标题
		// print $_GPC['introduce_auto_id'];
	}
	/**
	 * 插入章节
	 */
	public function doWebCatalogInsert() {
		global $_GPC;
		// print_r($_GPC['introduce_auto_id']);
		// print_r($_GPC['catalog']);
		$insert = pdo_insert ( $this::CATALOG, array (
				'introduce_auto_id' => $_GPC ['introduce_auto_id'],
				'catalog' => $_GPC ['catalog'] 
		) ); // 插入记录
		if ($insert) {
			exit ( '添加成功' );
		}
	}
	
	/**
	 * 删除章节
	 */
	public function doWebCatalogDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::CATALOG, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebCatalog ();
	}
	
	/**
	 * 获取联系我们信息
	 */
	public function doWebContactUs() {
		$data = pdo_getall ( $this::CONTACTUS );
		// print_r ( $data );
		include $this->template ( 'contact_us' );
	}
	/**
	 * 更新联系我们
	 */
	public function doWebUpdataContactUs() {
		global $_GPC;
		pdo_update ( $this::CONTACTUS, array (
				'work_time' => $_GPC ['work_time'],
				'EM' => $_GPC ['em'],
				'QQ' => $_GPC ['qq'],
				'weixin' => $_GPC ['weixin'] 
		) );
		exit ( '更新成功' );
	}
	
	/**
	 * 完本小说
	 */
	public function doWebFinishBook() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '完本列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::FINISHIBOOK );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::FINISHIBOOK, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'finish_book' );
	}
	
	/**
	 * 删除完本小说
	 */
	public function doWebFinishBookDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::FINISHIBOOK, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebFinishBook ();
	}
	
	/**
	 * 完本小说获取简介
	 */
	public function doWebFinishBookGetIntroduce() {
		global $_GPC;
		$data = pdo_getall ( $this::INTRODUCE, 'auto_id=' . $_GPC ['introduce_auto_id'] );
		
		// 获取输出字段，如果没有数据输出空
		if (count ( $data ) > 0) {
			print_r ( json_encode ( $data [0] ) );
		} else {
			print_r ( '简介编号不存在' );
		}
		// 获取输出字段，如果没有数据输出空
	}
	
	/**
	 * 完本小说添加新记录
	 */
	public function doWebFinishBookInsert() {
		global $_GPC;
		$insert = pdo_insert ( $this::FINISHIBOOK, array (
				'src' => $_GPC ['src'],
				'title' => $_GPC ['title'],
				'sex' => $_GPC ['sex'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'] 
		) );
		exit ( '添加成功' );
	}
	
	/**
	 * 猜你喜欢
	 */
	public function doWebguesslike() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '猜你喜欢列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::GUESSLIKE );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::GUESSLIKE, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'guess_like' );
	}
	
	/**
	 * 猜你喜欢删除
	 */
	public function doWebguesslikeDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::GUESSLIKE, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebguesslike ();
	}
	/**
	 * 添加猜你喜欢
	 */
	public function doWebGuessLikeInsert() {
		global $_GPC;
		pdo_insert ( $this::GUESSLIKE, array (
				'introduce_auto_id' => $_GPC ['introduce_auto_id'],
				'title' => $_GPC ['title'],
				'src' => $_GPC ['pic_addr'],
				'user' => $_GPC ['user'] 
		) ); // 添加猜你喜欢记录
		exit ( '添加成功' );
	}
	
	/**
	 * 热门小说
	 */
	public function doWebhot() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '热门列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::HOT );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::HOT, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'hot' );
	}
	
	/**
	 * 删除热门小说
	 */
	public function doWebhotDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::HOT, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebhot ();
	}
	/**
	 * 插入热门小说
	 */
	public function doWebhotInsert() {
		global $_GPC;
		pdo_insert ( $this::HOT, array (
				'src' => $_GPC ['src'],
				'title' => $_GPC ['title'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'],
				'sex' => $_GPC ['sex'] 
		) ); // 添加热门小说
		exit ( '添加成功' );
	}
	
	/**
	 * 小说简介
	 */
	public function doWebinstroduce() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '简介列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::INTRODUCE );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::INTRODUCE, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'introduce' );
	}
	
	/**
	 * 删除介绍
	 */
	public function doWebintroduceDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::INTRODUCE, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebinstroduce ();
	}
	/**
	 * 插入数据
	 */
	public function doWebintroduceSave() {
		global $_GPC;
		
		// 默认数据初始值
		$title = '';
		$des1 = '';
		$des2 = '';
		$src = '';
		$come_time = date ( 'Y-m-d H:i:s', time () );
		$line_one_auto_id = 1;
		$line_two_auto_id = 1;
		$line_three_auto_id = 1;
		$line_four_auto_id = 1;
		$is_member = 0;
		$need_bi = 0;
		// 默认数据初始值
		
		// 获取数值
		if (isset ( $_GPC ['title'] )) {
			if ($_GPC ['title'] != '')
				$title = $_GPC ['title'];
			// print $title;
			// print "<br>";
		}
		if (isset ( $_GPC ['des1'] )) {
			if ($_GPC ['des1'] != '')
				$des1 = $_GPC ['des1'];
			// print $des1;
			// print "<br>";
		}
		if (isset ( $_GPC ['des2'] )) {
			if ($_GPC ['des2'] != '')
				$des2 = $_GPC ['des2'];
			// print $des2;
			// print "<br>";
		}
		if (isset ( $_GPC ['src'] )) {
			if ($_GPC ['src'] != '')
				$src = $_GPC ['src'];
			// print $src;
			// print "<br>";
		}
		if (isset ( $_GPC ['come_time'] )) {
			if ($_GPC ['come_time'] != '')
				$come_time = $_GPC ['come_time'];
			// print $come_time;
			// print "<br>";
		}
		if (isset ( $_GPC ['line_one_auto_id'] )) {
			if ($_GPC ['line_one_auto_id'] != '')
				$line_one_auto_id = $_GPC ['line_one_auto_id'];
			// print $line_one_auto_id;
			// print "<br>";
		}
		if (isset ( $_GPC ['line_two_auto_id'] )) {
			if ($_GPC ['line_two_auto_id'] != '')
				$line_two_auto_id = $_GPC ['line_two_auto_id'];
			// print $line_two_auto_id;
			// print "<br>";
		}
		if (isset ( $_GPC ['line_three_auto_id'] )) {
			if ($_GPC ['line_three_auto_id'] != '')
				$line_three_auto_id = $_GPC ['line_three_auto_id'];
			// print $line_three_auto_id;
			// print "<br>";
		}
		if (isset ( $_GPC ['line_four_auto_id'] )) {
			if ($_GPC ['line_four_auto_id'] != '')
				$line_four_auto_id = $_GPC ['line_four_auto_id'];
			// print $line_four_auto_id;
			// print "<br>";
		}
		if (isset ( $_GPC ['is_member'] )) {
			if ($_GPC ['is_member'] != '')
				$is_member = $_GPC ['is_member'];
			if ($is_member == '否') {
				$is_member = '0';
			} else {
				$is_member = '1';
			}
			// print $is_member;
			// print "<br>";
		}
		if (isset ( $_GPC ['need_bi'] )) {
			if ($_GPC ['need_bi'] != '')
				$need_bi = intval ( $_GPC ['need_bi'] );
			// print $need_bi;
			// print "<br>";
		}
		// 获取数值
		
		$insert = pdo_insert ( $this::INTRODUCE, array (
				'title' => $title,
				'des1' => $des1,
				'des2' => $des2,
				'src' => $src,
				'come_time' => $come_time,
				'line_one_auto_id' => $line_one_auto_id,
				'line_two_auto_id' => $line_two_auto_id,
				'line_three_auto_id' => $line_three_auto_id,
				'line_four_auto_id' => $line_four_auto_id,
				'is_member_read' => $is_member,
				'need_bi' => $need_bi 
		) ); // 插入数据
		
		exit ( '数据保存成功' ); // 输出消息
	}
	
	/**
	 * 限时免费
	 */
	public function doWeblimittimefree() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '限时免费列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::LIMITTIMEFREE );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::LIMITTIMEFREE, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'limittimefree' );
	}
	
	/**
	 * 限时免费删除
	 */
	public function doWeblimittimefreeDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::LIMITTIMEFREE, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWeblimittimefree ();
	}
	
	/**
	 * 添加插入
	 */
	public function doWeblimittimefreeInsert() {
		global $_GPC;
		pdo_insert ( $this::LIMITTIMEFREE, array (
				'src' => $_GPC ['src'],
				'title' => $_GPC ['title'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'],
				'sex' => $_GPC ['sex'] 
		) ); // 插入新记录
		exit ( '添加成功' );
	}
	
	/**
	 * 轮播图片
	 */
	public function doWeblunbo() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '轮播列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::LUNBO );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::LUNBO, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'lunbo' );
	}
	
	/**
	 * 删除轮播图
	 */
	public function doWeblunboDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::LUNBO, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWeblunbo ();
	}
	
	/**
	 * 添加轮播
	 */
	public function doWeblunboInsert() {
		global $_GPC;
		pdo_insert ( $this::LUNBO, array (
				'src' => $_GPC ['src'],
				'title' => $_GPC ['title'],
				'des' => $_GPC ['des'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'] 
		) ); // 插入记录
		exit ( '添加成功' );
	}
	
	/**
	 * 获取会员信息
	 */
	public function doWebmemberinfo() {
		$data = pdo_getall ( $this::MEMBERINFO );
		
		include $this->template ( 'member_info' );
	}
	
	/**
	 * 更新会员信息
	 */
	public function doWebUpdataMemberInfo() {
		global $_GPC;
		pdo_update ( $this::MEMBERINFO, array (
				'open_id' => $_GPC ['open_id'],
				'bi' => $_GPC ['bi'] 
		) );
		exit ( '更新成功' );
	}
	
	/**
	 * 会员开通分类
	 */
	public function doWebmemberkind() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '会员分类列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::MEMBERKIND );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::MEMBERKIND, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'member_kind' );
	}
	
	/**
	 * 删除会员分类
	 */
	public function doWebmemberkindDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::MEMBERKIND, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebmemberkind ();
	}
	
	/**
	 * 添加会员分类信息
	 */
	public function doWebmemberkindInsert() {
		global $_GPC;
		pdo_insert ( $this::MEMBERKIND, array (
				'member_kind' => $_GPC ['member_kind'],
				'member_day' => $_GPC ['member_day'],
				'money' => $_GPC ['money'] 
		) );
		exit ( '添加成功' );
	}
	
	/**
	 * 会员说明信息
	 */
	public function doWebmembermemo() {
		$data = pdo_getall ( $this::MEMBERMEMO );
		include $this->template ( 'member_memo' );
	}
	
	/**
	 * 更新备忘录
	 */
	public function doWebUpdataMemberMemo() {
		global $_GPC;
		pdo_update ( $this::MEMBERMEMO, array (
				'member_memo' => $_GPC ['member_memo'] 
		) ); // 更新记录
		exit ( '更新成功' );
	}
	
	/**
	 * 新书推荐
	 */
	public function doWebnewbook() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '新书列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::NEWBOOK );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::NEWBOOK, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'new_book' );
	}
	
	/**
	 * 删除新书
	 */
	public function doWebnewbookDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::NEWBOOK, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebnewbook ();
	}
	
	/**
	 * 插入新书
	 */
	public function doWebnewbookSave() {
		global $_GPC;
		pdo_insert ( $this::NEWBOOK, array (
				'src' => $_GPC ['src'],
				'title' => $_GPC ['title'],
				'sex' => $_GPC ['sex'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'] 
		) ); // 插入记录
		exit ( '添加成功' );
	}
	
	/**
	 * 小说明细
	 */
	public function doWebnoveldetail() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '小说明细列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::NOVELDETAIL );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::NOVELDETAIL, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'novel_detail' );
	}
	
	/**
	 * 删除小说明细
	 */
	public function doWebnoveldetailDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::NOVELDETAIL, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebnoveldetail ();
	}
	
	/**
	 * 添加小说详细信息
	 */
	public function doWebnoveldetailInsert() {
		global $_GPC;
		
		pdo_insert ( $this::NOVELDETAIL, array (
				'src' => $_GPC ['src'],
				'book_name' => $_GPC ['title'],
				'author' => $_GPC ['author'],
				'status' => $_GPC ['status'],
				'des' => $_GPC ['des'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'] 
		) );
		exit ( '添加成功' );
	}
	/**
	 * 读小说
	 */
	public function doWebreadnovel() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '小说内容列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::READNOVEL );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::READNOVEL, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'read_novel' );
	}
	
	/**
	 * 删除小说
	 */
	public function doWebrealnovelDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::READNOVEL, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebreadnovel ();
	}
	
	/**
	 * 获取最近章编号
	 */
	public function doWebGetCatalogAutoId() {
		$data = pdo_getall ( $this::CATALOG, array (), array (), array (), 'auto_id desc', '20' );
		exit ( json_encode ( $data ) );
	}
	
	/**
	 * 检查某个章编号是否存在
	 */
	public function doWebCheckCatalogIdExists() {
		global $_GPC;
		$data = pdo_getall ( $this::CATALOG, 'auto_id=' . $_GPC ['catalog_auto_id'] );
		if (count ( $data ) > 0) {
			exit ( '存在' );
		} else {
			exit ( '章编号不存在' );
		}
	}
	
	/**
	 * 加入小说阅读内容
	 */
	public function doWebreadnovelInsert() {
		global $_GPC;
		pdo_insert ( $this::READNOVEL, array (
				'catalog_auto_id' => $_GPC ['catalog_auto_id'],
				'content' => $_GPC ['content'] 
		) );
		exit ( '添加成功' );
	}
	
	/**
	 * 最近阅读记录
	 */
	public function doWebrecentreadrecord() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '最近阅读列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::RECENTREADRECORD );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::RECENTREADRECORD, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'recent_read_record' );
	}
	
	/**
	 * 删除最近阅读就
	 */
	public function doWebrecentreadrecordDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::RECENTREADRECORD, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebrecentreadrecord ();
	}
	
	/**
	 * 充值类型
	 */
	public function doWebrechargekind() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '充值类型列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::RECHARGEKIND );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::RECHARGEKIND, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'recharge_kind' );
	}
	
	/**
	 * 删除充值类型
	 */
	public function doWebrechargekindDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::RECHARGEKIND, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebrechargekind ();
	}
	
	/**
	 * 添加充值类型
	 */
	public function doWebrechargekindInsert() {
		global $_GPC;
		pdo_insert ( $this::RECHARGEKIND, array (
				'money' => $_GPC ['money'],
				'bi' => $_GPC ['bi'] 
		) );
		exit ( '添加成功' );
	}
	
	/**
	 * 充值说明
	 */
	public function doWebrechargememo() {
		global $_GPC;
		$data = pdo_getall ( $this::RECHARGEMEMO );
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '充值说明';
		}
		include $this->template ( 'recharge_memo' );
	}
	
	/**
	 * 更新充值说明
	 */
	public function doWebrechargememoUpdate() {
		global $_GPC;
		pdo_update ( $this::RECHARGEMEMO, array (
				'memo' => $_GPC ['memo'] 
		) );
		exit ( '更新成功' );
	}
	public function doWebtuijian() {
		global $_GPC;
		
		if (isset ( $_GPC ['kind'] ) == false) {
			$_GPC ['kind'] = '小说推荐列表';
		}
		
		// 获取总页数
		$total_page = 0;
		$total_page = $this->get_total_page ( $this::TUIJIAN );
		// 获取总页数
		
		if ($_GPC ['direct'] == '') { // 如果还未设置就先设置
			$_GPC ['direct'] = '+';
			// print "fdsfdsfds";
		}
		
		// 设置当前页数
		$current_page = 0;
		if (isset ( $_GPC ['current_page'] )) {
			$current_page = $_GPC ['current_page'];
			if ($_GPC ['direct'] == '+') { // 如果是加号就累加
				$current_page ++;
			}
			if ($_GPC ['direct'] == '-') { // 如果是累减一个
				$current_page --;
			}
			if ($_GPC ['direct'] == '++') { // 最后一页
				$current_page = $total_page;
			}
		} else {
			$current_page = 1;
		}
		// 设置当前页数
		
		// 根据不通页码显示或隐藏按钮
		// $this->dealWithFlag ( );
		if ($current_page > 1 && $current_page < $total_page) { // 如果是中间
			$is_pre = true; // 前一页标志
			$is_next = true; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = true;
		}
		
		if ($current_page <= 1) {
			
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = true; // 下一页标志
			$is_last = true;
		}
		if ($current_page == $total_page) {
			$is_pre = true; // 前一页标志
			$is_next = false; // 下一页标志
			$is_first = true; // 第一页显示
			$is_last = false;
		}
		
		if ($total_page == 1) {
			$is_pre = false; // 前一页标志
			$is_first = false; // 第一页显示
			$is_next = false; // 下一页标志
			$is_last = false;
		}
		// print_r ( $total_page );
		// 根据不通页码显示或隐藏按钮
		
		// print_r($current_page);
		
		$offset = ($current_page - 1) * 20;
		$data = pdo_getall ( $this::TUIJIAN, array (), array (), array (), array (
				'auto_id desc' 
		), $offset . ',20' );
		
		include $this->template ( 'tui_jian' );
	}
	
	/**
	 * 删除推荐
	 */
	public function doWebtuijianDel() {
		global $_GPC;
		foreach ( $_GPC as $key => $item ) {
			if (strpos ( $key, 'checkvalue' ) !== false && $item == 'on') {
				// print "fa";
				// print str_replace('checkvalue', '', $key);
				$result = pdo_delete ( $this::TUIJIAN, array (
						'auto_id' => str_replace ( 'checkvalue', '', $key ) 
				) );
			}
			// print_r($item) . " <br>";
			// print_r($key) . " <br>";
		}
		$this->doWebtuijian ();
	}
	
	/**
	 * 添加推荐小说
	 */
	public function doWebtuijianInsert() {
		global $_GPC;
		pdo_insert ( $this::TUIJIAN, array (
				'src' => $_GPC ['src'],
				'title' => $_GPC ['title'],
				'introduce_auto_id' => $_GPC ['introduce_auto_id'],
				'sex' => $_GPC ['sex'] 
		) );
		exit ( '保存成功' );
	}
}