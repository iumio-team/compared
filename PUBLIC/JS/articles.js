var scene = null, mX=0, mY=0, rY= null, rX=null, sTX = 0, sceneTX = 0;

var INTERACT = {
    SELECT: 0,
    BACK: 1
  };

/************ STACKS **************/
var STACKS = [
  { 'title': 'Code',  'items': { 'project one': {}, 'project two': {}, 'project three': {} } },
  { 'title': 'Design',  'items': { 'project one': {}, 'project two': {}, 'project three': {} } },
  { 'title': 'Artwork',  'items': { 'project one': {}, 'project two': {}, 'project three': {} } },
  { 'title': 'Resume',  'items': { 'project one': {}, 'project two': {}, 'project three': {} } }
];

/*********** GIBSON **************/
var Gibson = {
  opts:{
    dims:{
      width:400,
      height:400,
      spacing:4
    },
    stack_data:{},
    holder_selector:'#scene'
  },
  holder:null,
  stacks:[],
  initialize:function ($opts) {
    ts = Gibson;
    ts.opts.count = ts.opts.stack_data.length;
    ts.holder = $(ts.opts.holder_selector);
    $.extend(ts.opts, $opts);
    ts.createStacks();
    var hWidth = ts.opts.count*ts.opts.dims.width;
    var hHeight = ts.opts.dims.height;
    ts.holder.css(
      {
        width: hWidth,
        height: hHeight,
        marginLeft: 0-(hWidth *.5) + 'px',
        marginTop: 0-(hHeight *.5) + 'px',
        left:"50%",
        top:"50%",
        position: 'absolute'
      }
    );
    
  },
  createStacks:function () {
    
    for(var ii=0; ii<ts.opts.count; ii++) {
      var newStack = Stack(ii);
      var tileIdx =ts.stacks.push(newStack);
      ts.holder.append(newStack.el); 
    }; 
    $.each(ts.stacks,function(idx,val){
      //  setTimeout(function(){
      $(val.el).animate(
        { 
          top:val.y + 'px', 
          left:val.x + 'px'
        }, 
        200+Math.random()*400); 
      //};//, 
      //            Math.random()*500);
    });
  }
};

var Stack = function ($id) {
  var _d = ts.opts.stack_data[$id];
  var _res = { el: null, idx:$id, x:null, y:null };
  var _row = 0;
  var _col = $id % ts.opts.count;
  var _el = $('<div/>');
  _el.append("<div><figure class='cube front'><header>"+_d.title+"</header></figure></div>");
  
  var _f = _el.find('figure').first();
  var _i = $('<ul/>');
  _f.append(_i);
  $.each(_d.items,function($key,$val){
    _i.append($('<li>'+$key+'</li>'));   
  });
  
  _res.el = _el; 
  
  var _deg =  ($id / ts.opts.count *360).toFixed();
  var dW = 2000;
  _res.el.css({
    width: ts.opts.dims.width,
    height: ts.opts.dims.height,
    left: ((dW/2)+Math.cos(_deg)*dW)+'px',
    top:((dW/2)+Math.sin(_deg)*dW)  +'px'
  }); 
  
  _res.x = (ts.opts.dims.width + ts.opts.dims.spacing) * _col;
  _res.y = (ts.opts.dims.height + ts.opts.dims.spacing) * _row;
  
  _res.el.addClass('tile');
  
  var _hsl = {
    h: Math.floor(Math.random()*360),
    s: Math.floor(Math.random()*90)+190,
    l: 40
  };
  
  $(_res.el).find('figure').css({
    'background-color': 'hsl('+_hsl.h+','+_hsl.s+'%,'+_hsl.l+'%)'
    //,'opacity': 0.5
  });
  
  return _res;
};

var depth = 0;
var active_stack = null;
var active_stack_items = null;
function updateSelector(){
  var hpos;
  if(depth==0){
    hpos = Math.floor((mX / $(window).width()) * ts.opts.count); 
    active_stack = $($('.tile')[hpos]);
    active_stack_items = active_stack.find('li');
    
    active_stack
      .addClass('active')
      .removeClass('inactive')
      .siblings()
      .addClass('inactive')
      .removeClass('active');
    sceneTX = hpos*-100;
  } else if (depth==1){
    hpos = Math.floor((mX / $(window).width()) * active_stack_items.length); 
    active_item = $(active_stack_items[hpos]);
    active_item.addClass('active').siblings().removeClass('active');        
  }
}

function adjustScene() {
  
  updateSelector();
  
  if(mX==0) return;
  _rX = -5 + ((mY / $(window).height()) * 10);
  _rY = -5 + ((mX / $(window).width()) * 10);
  
  if(rX==null) rX = _rX;
  if(rY==null) rY = _rY;
  
  rX = rX*.8 + _rX*.2;
  rY =  rY*.8 + _rY*.2;
  
  rX = rX.toFixed(2);
  rY = rY.toFixed(2);
  
  sTX =  sTX*.9 + sceneTX*.1;
  var newcss ='rotateX('+rX+'deg) rotateY('+-rY+'deg) translateX('+sTX+'px)';
  scene.css({
    '-webkit-transform':newcss,
    '-o-transform':newcss,
    '-moz-transform':newcss,
    '-ms-transform':newcss
  });
  
}




(function($, self){
  
  if(!$ || !self) {
    return;
  }
  
  for(var i=0; i<self.properties.length; i++) {
    var property = self.properties[i],
        camelCased = StyleFix.camelCase(property),
        PrefixCamelCased = self.prefixProperty(property, true);
    
    $.cssProps[camelCased] = PrefixCamelCased;
  }
  
})(window.jQuery, window.PrefixFree);



$(function () {
  scene = $('#scene');
  
  Gibson.opts.stack_data = STACKS;
  Gibson.initialize();
  
$(document).bind('touchmove',
function(ev) {
    
  ev.preventDefault();

}
);
  $(window).bind("mousemove touchmove",function (e) {
    var ev = e.originalEvent;
    var o = (ev.hasOwnProperty('touches') ? ev.touches[0] : ev);
    mX = o.pageX;
    mY = o.pageY;
  });
  
  $(window).bind('contextmenu',function(ev){
    return false;
  });
  $(window).bind('touchstart touchend',function(e){
    var oEvent = e.originalEvent;
$.each(oEvent.touches,function(idx,val){
      if(!val.hasOwnProperty('startX')) {
        val['startX'] = val.pageX;
        val['startY'] = val.pageY;
      } else {
        var a= val.pageX - val.startX;
        var b = val.pageY - val.startY;
         val['distance'] = Math.sqrt((a*a) + (b*b));
      }
    });    
  });
  $(window).bind('mousedown touchend',function(e){
    var o,interact_type, ev;
    e.preventDefault();    
    ev = e.originalEvent;    

    
    if(ev.hasOwnProperty('touches')) {
      // TOUCH EVENT
      
      o = ev.targetTouches[0];
      
      $('debug').text([ 'touch: ', 'd=', o.distance ].join(' '));
     
      interact_type = ev.touches.length > 1 ? INTERACT.BACK : INTERACT.SELECT;
      if(o.distance > 5) { return; }
    }
    else
    {
      // MOUSE EVENT
      
      $('debug').text('mouse');
      o = e;
      interact_type = ev.which == 1 ? INTERACT.SELECT : INTERACT.BACK;
    }
    switch (interact_type) {
      case (INTERACT.SELECT):
        if(depth == 0){
          depth=1;
          active_stack.addClass('selected').siblings().removeClass('selected');       
        }
        break;
      case (INTERACT.BACK):
        if(depth>0) 
        {
          depth = depth-1;
          active_stack.removeClass('selected');
        }
        break;
      default: break;
    }
    
    
    return false;
  });
  
  setInterval(adjustScene,33);
  
  $('footer.badge').appendTo('body>header');
});