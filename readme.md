# 接口文档 #
## 1.公共模块 ##
### 1.1 首页banner图 ###
url:http://pro.cuithink.com/commons/banner_list

type:get 

param:

return:

{
    "code": "200",
    "msg": "",
    "data": {
        "result": [
            {
                "id": "1",
                "name": "test",
                "img": "http://www.pro.com/static/uploads/1.png",
                "sort": "1"
            }
        ],
        "total": 1
    }
}

## 2.商品模块 ##
### 2.1 商品分类 ###
#### 2.1.1 商品分类列表 ####
url:http://pro.cuithink.com/type/good_type_list

type:get 

param:

return:

{
    "code": "200",
    "msg": "",
    "data": {
        "result": [
            {
                "id": "2",
                "name": "蔬菜",
                "sort": "2"
            },
            {
                "id": "1",
                "name": "农产品
                "sort": "1"
            }
        ],
        "total": 2
    }
}

#### 2.1.2 商品分类添加 ####

url:http://pro.cuithink.com/type/add

type:post 

param:
     name：'农产品',//分类名称
     sort：1,//排序
	 id:1    //修改时候添加

return:

{
    "code": "200",
    "msg": 200,
    "data": "操作成功"
}

#### 2.1.2 商品分类删除 ####


url:http://pro.cuithink.com/type/del

type:post 

param:
	 id:1    //id

return:

{
    "code": "200",
    "msg": 200,
    "data": "操作成功"
}

### 2.2 商品模块 ###

#### 2.2.1 商品列表 ####

url:http://pro.cuithink.com/good/good_list

type:get 

param:
	type_id:1,  //商品分类id
	shop_id：1, //商家id
	page:1,     //页码
	page_size:15 //每页多少条

return:

{
    "code": "200",
    "msg": "",
    "data": {
        "result": [
            {
                "id": "44",
                "name": "商品名称",
                "type_id": "1",
                "shop_id": "15",
                "img": [
                    "http://www.pro.com/static/uploads/goods/15029520670.png",
                    "http://www.pro.com/static/uploads/goods/15029520671.png"
                ],
                "price": "12",
                "sale_price": null,
                "stock": "100",
                "desc": "我是小小鸟",
                "sort": "13",
                "is_show": "1"
            },
            {
                "id": "40",
                "name": "商品名称",
                "type_id": "1",
                "shop_id": "15",
                "img": [
                    "http://www.pro.com15029416200.png",
                    "http://www.pro.com15029416201.png"
                ],
                "price": "12",
                "sale_price": null,
                "stock": "100",
                "desc": "我是小小鸟",
                "sort": "10",
                "is_show": "1"
            },
            {
                "id": "39",
                "name": "商品名称",
                "type_id": "1",
                "shop_id": "15",
                "img": null,
                "price": "12",
                "sale_price": null,
                "stock": "100",
                "desc": "我是小小鸟",
                "sort": "9",
                "is_show": "1"
            },
            {
                "id": "30",
                "name": "鲈鱼",
                "type_id": "2",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "90",
                "desc": "鲈鱼",
                "sort": "2",
                "is_show": "1"
            },
            {
                "id": "6",
                "name": "鸟肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "鸟肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "7",
                "name": "肉鸟",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "肉鸟",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "8",
                "name": "五花肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "五花肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "9",
                "name": "前腿肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "前腿肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "10",
                "name": "精肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "精肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "11",
                "name": "精瘦肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "精瘦肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "12",
                "name": "小肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "小肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "13",
                "name": "大肉",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "大肉",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "14",
                "name": "亚瑟",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "亚瑟",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "15",
                "name": "关羽",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "关羽",
                "sort": "1",
                "is_show": "1"
            },
            {
                "id": "16",
                "name": "张飞",
                "type_id": "1",
                "shop_id": "1",
                "img": [
                    "http://www.pro.com/static/uploads/goods/1.png"
                ],
                "price": "10.5",
                "sale_price": "5",
                "stock": "100",
                "desc": "张飞",
                "sort": "1",
                "is_show": "1"
            }
        ],
        "total": 27
    }
}

#### 2.2.2 商品删除 ####

url:http://pro.cuithink.com/good/del

type:post 

param:
	 id:1    //id

return:

{
    "code": "200",
    "msg": 200,
    "data": "操作成功"
}

#### 2.2.3 商品详情 ####

url:http://pro.cuithink.com/good/detail

type:get 

param:
	 id:1    //id

return:

{
    "code": "200",
    "msg": "",
    "data": {
        "id": "44",
        "name": "商品名称",
        "type_id": "1",
        "shop_id": "15",
        "img": [
            "http://www.pro.com/static/uploads/goods/15029520670.png",
            "http://www.pro.com/static/uploads/goods/15029520671.png"
        ],
        "price": "12",
        "sale_price": null,
        "stock": "100",
        "desc": "我是小小鸟",
        "sort": "13",
        "is_show": "1"
    }
}


#### 2.2.4 买家购买 ####

url:http://pro.cuithink.com/good_cart/add

type:post 

param:
	 uid:'agagag',    //买家uid
	 good_id:1,       //商品id
	 num:2            //买了几件

return:

{
    "code": "200",
    "msg": 200,
    "data": "操作成功"
}


#### 2.2.5 订单列表 ####

url:http://pro.cuithink.com/good_cart/cart_list

type:get 

param:
	 uid:'agagag',    //买家/卖家 uid

return:

{
    "code": "200",
    "msg": "",
    "data": {
        "result": [
            {
                "num": "2",
                "create_time": "2017-08-17 10:02:10",
                "uid": "EB565340-E3D1-2BCA-43A8-8D1F389F15F4",
                "name": "鲈鱼",
                "img": "/static/uploads/goods/1.png",
                "price": "10.5",
                "desc": "鲈鱼"
            },
            {
                "num": "2",
                "create_time": "2017-08-17 10:02:23",
                "uid": "EB565340-E3D1-2BCA-43A8-8D1F389F15F4",
                "name": "鲈鱼",
                "img": "/static/uploads/goods/1.png",
                "price": "10.5",
                "desc": "鲈鱼"
            }
        ],
        "total": 2
    }
}


#### 2.2.6 商品添加 ####


url:http://pro.cuithink.com/good_cart/add

type:post 

param:
	 name:'荷兰土豆',     //商品名称
	 price:10.5,        //价格
	 type_id:2         //分类id
	 uid:'agagag',    //卖家家uid
	 stock:100,      //库存
	 desc:商品描述   //商品描述
	 img: 可以上传多个图片        //图片上传

return:

{
    "code": "200",
    "msg": 200,
    "data": "操作成功"
}
