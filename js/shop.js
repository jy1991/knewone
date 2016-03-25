
//图片震动特效
var typ=["paddingTop","paddingLeft"],rangeN=5,timeout=20; 
function shake(e,end){ 
var range=Math.floor(Math.random()*rangeN); 
var typN=Math.floor(Math.random()*typ.length); 
e["style"][typ[typN]]=""+range+"px"; 
var shakeTimer=setTimeout(function(){shake(e,end)},timeout); 
e[end]=function(){clearTimeout(shakeTimer)}; 
} 
//图片震动特效
