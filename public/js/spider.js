(function($, AdminLTE){
    
    "use strict";
    
    $(document).ready(function() {
//        $(".btn-sq").hover(
//            function(){
//                $(this).removeClass("btn-default");
//                $(this).addClass("btn-success");
//            }, function(){
//                $(this).addClass("btn-default");
//                $(this).removeClass("btn-success");
//            }
//        );
        
        $(".btn-sq").on("click", function(){
            if ($(this).attr("id") != "newCategory") {
                $(".btn-sq").removeClass("btn-success").addClass("btn-default");
                $(this).removeClass("btn-default").addClass("btn-success");
            }
        });
    });
    
})(jQuery, $.AdminLTE);