$(function(){
    var liWidth = $("#galeria ul li").outerWidth(),
        speed = 3500,
        rotate = setInterval(auto, speed);
    
    // ESSA FUNÇÃO PERMITE QUE BOTÕES APAREÇAM ENQUANTO O MOUSE ESTIVER POSICIONADO SOBRE O SLIDE
    $("div#galeria").hover(function(){
        $("div#buttons").fadeIn();
        
        clearInterval(rotate);
        
        // ESSA FUNÇÃO FAZ OS BOTÕES SUMIREM QUANDO O MOUSE ESTIVER POSICIONADO FORA DO SLIDE
    }, function(){
        $("div#buttons").fadeOut();
        
        rotate = setInterval(auto, speed);
    });
    
    // PRÓXIMA IMAGEM
    $(".next").click(function(e){
        e.preventDefault();
        
        $("div#galeria ul").css({'width':'99999%'}).animate({left:-liWidth}, function(){
            $("#galeria ul li").last().after($("#galeria ul li").first());
            $(this).css({'left':'0', 'width':'auto'});
        });
    });
    
    // VOLTAR IMAGEM
    $(".prev").click(function(e){
        e.preventDefault();
        
        $("#galeria ul li").first().before($("#galeria ul li").last().css({'margin-left':-liWidth}));
        $("div#galeria ul").css({'width':'99999%'}).animate({left:liWidth}, function(){
            
            $("#galeria ul li").first().css({'margin-left':'0'});
            $(this).css({'left':'0', 'width':'auto'});
        });
    });
    
    function auto(){
        $(".next").click();
    }
});