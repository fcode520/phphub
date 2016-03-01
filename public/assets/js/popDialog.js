(function ( $ ) {
 
    $.fn.successPOP = function( options ) {
        if(this.find('div').length < 1){
            this.html('<b><span></span><span></span></b>');
        }        
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            text: "操作成功",
            backgroundColor: "#fff",
            color: '#5fcf80',
            fontsize: '15px',
            padding: '30px 80px',
            align:'center',
            width:'100%',
            position:'relative',
            top:'200px'
        }, options );

        var _this = this;
        setTimeout(function(){
        	_this.fadeOut(500); 
        },1200);

        this.find('b').first().css({
            border:'1px solid #f0efef',
            boxShadow:'0 0 5px #f0efef',
            borderRadius:'4px',
            padding:'30px 0',
            display:'inline-block'
        });
 		
 		
 		this.css({    
 			textAlign:settings.align,       
            color: settings.color,
            top: settings.top,
            margin:settings.margin,
            minWidth:settings.minwidth,
            width:settings.width,
            fontSize:settings.fontsize,
            position:settings.position,
            top:settings.top
        }).fadeIn(500);

        this.find('span').last().text(settings.text).css({
 			padding:settings.padding,
 			backgroundColor: settings.backgroundColor,
 		});

        this.find('span').first().removeClass().addClass('glyphicon glyphicon-ok-sign');
        $('.glyphicon-ok-sign').css({
            color:'#5ecf80',
            left:'75px'
        });


        return this;
 
    };

    $.fn.errorPOP = function( options ) {
        if(this.find('b').length < 1){
            this.html('<b><span></span><span></span></b>');
        } 
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            text: "操作失败",
            backgroundColor: "#fff",
            color: '#db0707',
            fontsize: '15px',
            padding: '30px 80px',
            align:'center',
            width:'100%',
            position:'relative',
            top:'200px'
        }, options );

        var _this = this;
        setTimeout(function(){
        	_this.fadeOut(500);
        },1200);

        this.find('b').first().css({
            border:'1px solid #f0efef',
            boxShadow:'0 0 5px #f0efef',
            borderRadius:'4px',
            padding:'30px 0',
            display:'inline-block'
        });
 
 		
 		this.css({            
 			textAlign:settings.align,
            color: settings.color,
            margin:settings.margin,                        
            minWidth:settings.minwidth,
            width:settings.width,
            fontSize:settings.fontsize,
            position:settings.position,
            top:settings.top
        }).fadeIn(500);

        this.find('span').last().text(settings.text).css({ 			
 			padding:settings.padding,
 			backgroundColor: settings.backgroundColor,
 		});

        this.find('span').first().removeClass().addClass('glyphicon glyphicon-remove-sign');
        $('.glyphicon-remove-sign').css({
            color:'#db0707',
            left:'75px'
        });


        // Greenify the collection based on the settings variable.
        return this;
 
    };

    $.fn.problemPOP = function( options ) {
        if(this.find('b').length < 1){
            this.html('<b><span></span><span></span></b>');
        } 
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            text: "你的操作系统没有接受，请重新操作！",
            backgroundColor: "#fff",
            color: '#666666',
            fontsize: '15px',
            padding: '0 80px',
            align:'center',
            width:'100%',
            position:'relative',
            top:'200px'
        }, options );

        var _this = this;
        setTimeout(function(){
         _this.fadeOut(500);
        },1200);
 
        this.find('b').first().css({
            border:'1px solid #f0efef',
            boxShadow:'0 0 5px #f0efef',
            borderRadius:'4px',
            padding:'30px 0',
            display:'inline-block'
        });

        this.css({            
            textAlign:settings.align,
            color: settings.color,
            margin:settings.margin,                        
            minWidth:settings.minwidth,
            backgroundColor: settings.backgroundColor,
            width:settings.width,
            fontSize:settings.fontsize,
            position:settings.position,
            top:settings.top
        }).fadeIn(500);

        this.find('span').last().text(settings.text).css({             
            padding:settings.padding,   
            backgroundColor: settings.backgroundColor,        

        });
        this.find('span').first().removeClass().addClass('glyphicon glyphicon-question-sign');
        $('.glyphicon-question-sign').css({
            color:'#ffcc00',
            left:'75px'
        });

        // Greenify the collection based on the settings variable.
        return this;
 
    };
 
}( jQuery ));

