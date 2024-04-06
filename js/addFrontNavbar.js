var html='<section style="background-color: #eee7e3;">'+
            '<div class="container"><div class="text-end"><span class="text-primary h3" id="user_message"></span></div></div></section>'+

            '<section>'+
                '<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark navbar-dark" style="height: 100px;">'+
                    '<div class="container">'+
                        '<a class="navbar-brand offset-2" href="../../index.html"><img src="../../images/front/bagel.png" width="60" alt="" class="iconNavBar"></a>'+
                    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>'+
                    '<div class="collapse navbar-collapse" id="navbarSupportedContent">'+     
                        '<ul class="navbar-nav me-auto mb-2 mb-lg-0">'+
                            '<li class="nav-item"><a class="nav-link" aria-current="page" href="../../index.html">首頁</a></li>'+
                            '<li class="nav-item"><a class="nav-link" aria-current="page" href="f_product_info.html">商品選購</a></li>'+
                            '<li class="nav-item" id="navItem_member"><a class="nav-link" aria-current="page" href="f_member_info.html">會員專區</a></li>'+
                        '</ul>'+    
                    '<div class="row flex-column text-center iconBtnMember me-3" id="btn_logout">'+
                        '<div class="col mt-3 "><i class="fa-solid fa-right-from-bracket fa-2x"></i></div><div class="col"><p>會員登出</p></div></div>'+  
                    '<a href="f_cart_info.html" style="text-decoration:none;"><div class="row flex-column text-center iconBtnShop" id="btn_shopcar" style="position: relative;">'+
                        '<div class="col mt-3 ">'+
                            '<i class="fa-solid fa-cart-shopping fa-2x"></i></div>'+
                        '<div class="col"><p>購物車</p></div>'+
                        '<div class="row" style="position: absolute; top: 20px; left: 40px; z-index: 20;"><span class="bg-danger rounded-pill badge" id="shopcarNum" style="width: 40px"></span></div>'+
                    '</div></a>'+
                    '</div></div></nav></section>';
document.write(html);