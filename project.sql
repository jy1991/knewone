--创建数据库
CREATE DATABASE IF NOT EXISTS `knewone_shop`;
--选择数据库
USE knewone_shop;
--创建用户表
CREATE TABLE IF NOT EXISTS `knewone_user`(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) UNIQUE,
  password CHAR(32) NOT NULL,
  email VARCHAR(255),
  phone VARCHAR(255),
  sex TINYINT NOT NULL DEFAULT 0,
  `type` TINYINT NOT NULL DEFAULT 0,-- 0 普通用户 -- 普通管理员 -- 超级管理员
  display TINYINT NOT NULL DEFAULT 0 -- 0 开启 1 禁止
)ENGINE=MYISAM DEFAULT CHARSET=utf8;

--添加超级管理员  
  INSERT INTO `knewone_user`(id,name,password,type,display) VALUES(NULL,'admin',md5('123456'),2,0); 
  
--创建商品分类表
CREATE TABLE IF NOT EXISTS `knewone_category`(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
pid INT UNSIGNED DEFAULT 0,
path VARCHAR(255),
`display` INT NOT NULL DEFAULT 1 -- 1 显示 2 隐藏 
)ENGINE=MYISAM DEFAULT CHARSET=utf8;

-- 创建商品表 knewone_goods
CREATE TABLE IF NOT EXISTS `knewone_goods`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    cate_id INT UNSIGNED NOT NULL ,         -- 分类id
    price DECIMAL(10,2) NOT NULL DEFAULT 0, -- 商品价格
    stock INT NOT NULL DEFAULT 0,           -- 商品库存
    `status` TINYINT NOT NULL DEFAULT 0,    -- 商品状态 0 卖完下架 1 有货速抢
    heart INT NOT NULL DEFAULT 0,           -- 收藏数  
    sell INT NOT NULL DEFAULT 0,            -- 销量
    comment INT NOT NULL DEFAULT 0,         -- 评论数目
    addtime INT UNSIGNED NOT NULL DEFAULT 0,-- 首次添加时间
    `describe` TEXT                         -- 商品描述
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 创建商品图片表 knewone_image
CREATE TABLE IF NOT EXISTS `knewone_image`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL DEFAULT '',
    goods_id INT UNSIGNED NOT NULL DEFAULT 0,
    is_face TINYINT NOT NULL DEFAULT 1  -- 1是封面  0 不是封面
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

--创建评论表
CREATE TABLE IF NOT EXISTS `knewone_comment`(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,          -- 评论名
  product_id INT UNSIGNED NOT NULL,    -- 商品id
  user_id INT UNSIGNED NOT NULL,       -- 用户id
  `describe` TEXT,                     -- 评论内容
  star TINYINT NOT NULL DEFAULT 5,     -- 评星
  hand INT UNSIGNED DEFAULT 0,         -- 被赞次数
  addtime INT UNSIGNED NOT NULL DEFAULT 0,-- 首次添加时间
  display TINYINT NOT NULL DEFAULT 0   -- 0 显示 1 屏蔽
)ENGINE=MYISAM DEFAULT CHARSET=utf8;

--创建客户表
CREATE TABLE IF NOT EXISTS `knewone_customer`(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) UNIQUE NOT NULL,    -- 用户名
  password CHAR(32) NOT NULL,           -- 密码
  email VARCHAR(255) NOT NULL,          -- 邮箱
  phone VARCHAR(255) NOT NULL,          -- 手机
  sex TINYINT DEFAULT 0,                -- 性别 0 男 1 女
  area VARCHAR(255),                    -- 地区
  web VARCHAR(255),                     -- 个人网站
 `describe` TEXT,                       -- 自我描述
  exp INT DEFAULT 0,                    -- 经验
  grade TINYINT DEFAULT 1,              -- 等级
  ko INT DEFAULT 0,                     -- KO币
  addtime INT UNSIGNED NOT NULL DEFAULT 0,   -- 注册时间
  display TINYINT NOT NULL DEFAULT 0         -- 0 开启 1 禁止
)ENGINE=MYISAM DEFAULT CHARSET=utf8;

-- 创建头像表 knewone_head
CREATE TABLE IF NOT EXISTS `knewone_head`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL DEFAULT '',
    person_id INT UNSIGNED NOT NULL DEFAULT 0
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建购物车 knewone_cart
CREATE TABLE IF NOT EXISTS `knewone_cart`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL DEFAULT 0,
    qty INT UNSIGNED NOT NULL DEFAULT 0,
    person_id INT UNSIGNED NOT NULL DEFAULT 0
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建收货地址 knewone_address
CREATE TABLE IF NOT EXISTS `knewone_address`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    address TEXT NOT NULL DEFAULT '',
    person VARCHAR(255) NOT NULL DEFAULT '',
    phone VARCHAR(255) NOT NULL, 
    `default` TINYINT NOT NULL DEFAULT 0,
    customer_id INT UNSIGNED NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 创建订单 knewone_order
CREATE TABLE IF NOT EXISTS `knewone_order`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(255) NOT NULL DEFAULT 0,
    person VARCHAR(255) NOT NULL DEFAULT '', 
    address TEXT NOT NULL DEFAULT '',
    phone VARCHAR(255) NOT NULL DEFAULT '', 
    customer_id INT UNSIGNED NOT NULL,
    sum INT NOT NULL DEFAULT 0,
    qty INT NOT NULL DEFAULT 0,
    `status` TINYINT NOT NULL DEFAULT 0,
    addtime VARCHAR(255) NOT NULL DEFAULT 0 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

--0 未付款
--1 已付款 未发货
--2 已付款 已发货
--3 确认收货
--4 交易关闭
--5 退货
--6 退款
--7 评论

-- 创建订单商品表 knewone_order_goods
CREATE TABLE IF NOT EXISTS `knewone_order_goods`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    goods_id INT UNSIGNED NOT NULL DEFAULT 0,
    goods_name VARCHAR(255),
    price DECIMAL(10,2) NOT NULL DEFAULT 0, 
    qty INT UNSIGNED NOT NULL DEFAULT 0,
    order_number VARCHAR(255) NOT NULL DEFAULT 0,
    is_comment TINYINT NOT NULL DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 创建评价表 knewone_comment
CREATE TABLE IF NOT EXISTS `knewone_comment`(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    goods_id INT UNSIGNED NOT NULL DEFAULT 0,
    customer_id INT UNSIGNED NOT NULL DEFAULT 0,
    `content` TEXT NOT NULL DEFAULT '',
    `star` TINYINT NOT NULL DEFAULT 5,
    order_number VARCHAR(255) NOT NULL DEFAULT 0,
    addtime VARCHAR(255) NOT NULL DEFAULT 0,
    display TINYINT NOT NULL DEFAULT 0 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
