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
        "id": "1",
        "name": "南瓜",
        "type_id": "1",
        "shop_id": "1",
        "img": "http://www.pro.com/static/uploads/1.png",
        "price": "10.5",
        "sale_price": "5",
        "stock": "100",
        "desc": "该产品很牛逼",
        "sort": "1",
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
                "id": "3",
                "uid": "EB565340-E3D1-2BCA-43A8-8D1F389F15F4",
                "good_id": "30",
                "num": "2",
                "create_time": "2017-08-17 10:02:10"
            },
            {
                "id": "4",
                "uid": "EB565340-E3D1-2BCA-43A8-8D1F389F15F4",
                "good_id": "30",
                "num": "2",
                "create_time": "2017-08-17 10:02:23"
            }
        ],
        "total": 2
    }
}