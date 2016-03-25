//拖拽方法
var zIndex = 1;
function drag(obj, vW){
    var obj = obj;
	var vW = vW?vW:document.documentElement.clientWidth; 
    var disX = 0;        
    var disY = 0;
    obj.onmousedown = function(ev){          
        var oEvent = ev || event;                        
        disX = oEvent.clientX - obj.offsetLeft;                      
        disY = oEvent.clientY - obj.offsetTop;                        
        obj.style.zIndex = zIndex;                       
        zIndex++;
        if (obj.setCapture) {                        
            obj.onmousemove = fnMove;                                    
            obj.onmouseup = fnUp;                                    
            obj.setCapture();                                    
        }       
        else {       
            document.onmousemove = fnMove;
            document.onmouseup = fnUp;           
        }
       function fnUp(){
           this.onmousemove = null;
           this.onmouseup = null;
            if (this.releaseCapture)             
                this.releaseCapture();
       }
       function fnMove(ev){
           var oEvent = ev || event;
           var l = oEvent.clientX - disX;
           var t = oEvent.clientY - disY;
           var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
           var w = vW- obj.offsetWidth;
           var h = document.documentElement.clientHeight - obj.offsetHeight + scrollTop;
           if (l < 10)             
                l = 0;
           if (l > w - 10)             
                l = w;            
            if (t < 10)             
                t = 0;
            if (t > h - 10)            
                t = h;
           obj.style.left = l + 'px';
           obj.style.top = t + 'px';
        }
       return false;
   }    
}