window.onload=function()
{
  waterfallInit({
	parent:'products',
	pin:'pin',  
  })	
}

 function waterfallInit(json)
{
  var parent=json.parent;
  var pin=json.pin;
  waterfall(parent,pin);	
  var ajaxState=true;
  var page=0;
  var requestNum=1;
  
  window.onscroll=function()
  { 
    if(checkScrollSite(parent,pin) && ajaxState)
	{ 
	  page++;
	  ajaxState=false;
	  ajaxRequest();
	}
  }
  
  function ajaxRequest()
  {
	$.ajax({
		  type:'GET',
		  url:'request.php',
		  data:'',
		  dataType:'json',
		  beforeSend: function()
		  {
			var oParent=document.getElementById(parent);
            var aPin=getClassObj(oParent,pin);	
			var lastPinH=aPin[aPin.length-1].offsetTop+aPin[aPin.length-1].offsetHeight;
			var loadImg=document.createElement('img');
			loadImg.src="./images/shop/load.gif"; 
			loadImg.id='loadImg';
			oParent.appendChild(loadImg);
			loadImg.style.position='absolute';
			loadImg.style.top = lastPinH + 60 +'px';
			loadImg.style.left = Math.floor((oParent.offsetWidth - loadImg.offsetWidth)/2) + 'px'; 
		  },
	      success:function(data)
		  { 
			var oParent=document.getElementById(parent);
			for(i in data)
			{ 
			  var oPin=document.createElement('div');
			  oPin.className='pin';
			  oParent.appendChild(oPin);
			  var oBox=document.createElement('div');
			  oBox.className='box';
			  oPin.appendChild(oBox);
			  var oA=document.createElement('a');
			  oA.href='product.php?product_id='+data[i].id;
			  oBox.appendChild(oA);
			  var oImg=document.createElement('img');
			  loadImg(data[i].src,callBack,oImg);
			  oImg.src=data[i].src;
			  oA.appendChild(oImg); 
			  var oContent=document.createElement('div');
			  oContent.className='content';
			  oPin.appendChild(oContent);
			  var oH4=document.createElement('h4');
			  oContent.appendChild(oH4);
			  var oA2=document.createElement('a');
			  oH4.innerHTML=data[i].name;
			  oH4.href='product.php?product_id='+data[i].id;
			  oH4.appendChild(oA2);
			  var oInfo=document.createElement('div');
			  oInfo.className='info';
			  oPin.appendChild(oInfo);
			  var oSpan=document.createElement('span');
			  oSpan.innerHTML='￥'+data[i].price+'&nbsp;&nbsp;&nbsp;&nbsp;现货';
			  oInfo.appendChild(oSpan);
			}
		   waterfall(parent,pin);	  
		  },
		  complete:function()
		  {
			document.getElementById(parent).removeChild(document.getElementById('loadImg'));
			ajaxState=true; 
		  }
	  })  
  }
}
/*
*   瀑布流
*   parent 父级ID
*   pin    商品块class
*/
function waterfall(parent,pin)
{
  var oParent=document.getElementById(parent);
  var aPin=getClassObj(oParent,pin);
  var num=Math.floor((oParent.offsetWidth-15)/(aPin[0].offsetWidth+15));
  var compareArr=[];
  for(var i=0;i<aPin.length;i++)
  {
	if(i<num)
	{
	  compareArr[i]=aPin[i].offsetHeight;
	}else
	{
	  var minH=Math.min.apply({},compareArr);
      var minKey=getMinKey(compareArr,minH);
      setMoveStyle(aPin[i],minH+15,aPin[minKey].offsetLeft,i);
	  compareArr[minKey]+=(aPin[i].offsetHeight+15);	
	}
  }

}

var startNum=0;
function setMoveStyle(obj,top,left,index)
{
   if(index <= startNum) //已经运动过的不再运动
   {
	 return;   
   }
   var documentW=document.documentElement.clientWidth;
   obj.style.position='absolute';
   obj.style.top= getTotalH() +'px';
   obj.style.left= Math.floor((documentW - obj.offsetWidth)/2)+'px';
   obj.style.opacity=0;
   obj.style.filter='alpha(opacity=0)';
   $(obj).stop().animate({
	   top:top,
	   left:left,
	   opacity:1
   },1000)
   startNum=index;
}

/*
*   选择商品块元素
*/
function getClassObj(parent,className)
{
  var obj=parent.getElementsByTagName("*");
  var result=[];
  for(var i=0;i<obj.length;i++)
  {
	if(obj[i].className==className)
	{
	  result.push(obj[i]);	
	}
  }
    return result;
}

/*
*   获取最小高度对应的键名
*/
function getMinKey(arr,minH)
{
  for(key in arr)
  {
	if(arr[key]==minH)
	{
	  return key;	
	}
  }
}

function callBack(w,h,imgObj)
{
  imgObj.style.width=245 + 'px';
  imgObj.style.height=Math.floor(h/(w/245))	+'px';
}

/*
*   图像加载函数 防止图片加载时还未获得top值
*/
function loadImg(url,fn,imgObj)
{
  var img = new Image();
  img.src = url;
  if(img.complete)
  {
	fn(img.width,img.height,imgObj);  
  }else
  {
	img.onload=function()
	{
	  fn(img.width,img.height,imgObj);  
	}
  }
}

/*
*   Ajax请求数据条件判断
*/
function checkScrollSite(parent,pin)
{
  if(getLastH(parent,pin) < getTotalH())
  {
	 return true; 
  }else
  {
	 return false;  
  }
}

/*
*   最下面的pin到顶部距离+其一半高度
*/
function getLastH(parent,pin)
{
  var oParent=document.getElementById(parent);
  var aPin=getClassObj(oParent,pin);	
  var lastPinH=aPin[aPin.length-1].offsetTop+Math.floor(aPin[aPin.length-1].offsetHeight/2);
  return lastPinH;	
}

/*
*   获取总高度
*/
function getTotalH()
{
   var scrollTop=document.documentElement.scrollTop || document.body.scrollTop;
   var documentH=document.documentElement.clientHeight;	
   var TotalH=scrollTop+documentH;
   return TotalH;
}


  var imgReady = (function() {
        var list = [], intervalId = null,
        // 用来执行队列
	    tick = function() {
	        var i = 0;
	        for (; i < list.length; i++) {
	            list[i].end ? list.splice(i--, 1) : list[i]();
	        };
	        !list.length && stop();
	    },
        // 停止所有定时器队列
	    stop = function() {
	        clearInterval(intervalId);
	        intervalId = null;
	    };
        return function(url, ready, load, error) {
            var onready, width, height, newWidth, newHeight,
			img = new Image();
            img.src = url;

            // 如果图片被缓存，则直接返回缓存数据
            if (img.complete) {
                ready.call(img);
                load && load.call(img);
                return;
            };
            width = img.width;
            height = img.height;
            // 加载错误后的事件
            img.onerror = function() {
                error && error.call(img);
                onready.end = true;
                img = img.onload = img.onerror = null;
            };
            // 图片尺寸就绪
            onready = function() {
                newWidth = img.width;
                newHeight = img.height;
                if (newWidth !== width || newHeight !== height ||
                // 如果图片已经在其他地方加载可使用面积检测
				newWidth * newHeight > 1024
			) {
                    ready.call(img);
                    onready.end = true;
                };
            };
            onready();
            // 完全加载完毕的事件
            img.onload = function() {
                // onload在定时器时间差范围内可能比onready快
                // 这里进行检查并保证onready优先执行
                !onready.end && onready();
                load && load.call(img);
                // IE gif动画会循环执行onload，置空onload即可
                img = img.onload = img.onerror = null;
            };
            // 加入队列中定期执行
            if (!onready.end) {
                list.push(onready);
                // 无论何时只允许出现一个定时器，减少浏览器性能损耗
                if (intervalId === null) intervalId = setInterval(tick, 40);
            };
        };
    })();