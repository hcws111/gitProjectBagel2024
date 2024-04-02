
var html = '<nav class="main-header navbar navbar-expand navbar-white navbar-light">'+
                '<ul class="navbar-nav">'+
                    '<li class="nav-item">'+
                        '<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>'+
                    '</li></ul>'+
                '<div id="webTitle">標題</div>'+
                '<ul class="navbar-nav ml-auto">'+
                    '<li class="nav-item">'+
                        '<a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-comments"></i><span class="badge badge-danger navbar-badge">3</span></a></li>'+
                    '<li class="nav-item">'+
                        '<a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-bell"></i><span class="badge badge-warning navbar-badge">15</span></a></li>'+
                '</ul></nav>'+
            '<aside class="main-sidebar sidebar-dark-primary elevation-4" id="addSidebar">'+
                '<a href="b_home.html" class="brand-link">'+
                    '<span class="brand-text font-weight-light">後台管理系統</span></a>'+
                    '<div class="text-white">管理者名稱: <span id="userName"></span></div>'+
                '<div class="sidebar">'+
                    '<nav class="mt-2">'+
                            '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">'+
                                '<li class="nav-item" id="sidebar_analysis">'+
                                    '<a href="#" class="nav-link">'+
                                        '<i class="nav-icon fa-solid fa-chart-line"></i><p>銷售<i class="right fas fa-angle-left"></i></p></a>'+
                                    '<ul class="nav nav-treeview">'+
                                    '<li class="nav-item">'+
                                            '<a href="b_overview.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>總覽</p></a></li>'+
                                    '</ul></li>'+
                                '<li class="nav-item" id="sidebar_member">'+
                                    '<a href="#" class="nav-link">'+
                                        '<i class="nav-icon fa-solid fa-user"></i><p>會員<i class="right fas fa-angle-left"></i></p></a>'+
                                    '<ul class="nav nav-treeview">'+
                                    '<li class="nav-item">'+
                                            '<a href="b_member_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>會員管理</p></a></li>'+
                                    '<li class="nav-item">'+
                                            '<a href="b_memberType_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>分類管理</p></a></li>'+
                                    '<li class="nav-item">'+
                                            '<a href="b_age_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>年齡層管理</p></a></li>'+
                                    '</ul></li>'+
                                '<li class="nav-item" id="sidebar_product">'+
                                    '<a href="#" class="nav-link">'+
                                        '<i class="nav-icon fa-solid fa-bread-slice"></i><p>商品<i class="right fas fa-angle-left"></i></p></a>'+
                                    '<ul class="nav nav-treeview">'+
                                        '<li class="nav-item">'+
                                            '<a href="b_product_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>商品管理</p></a></li>'+
                                        '<li class="nav-item">'+
                                            '<a href="b_productType_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>分類管理</p></a></li>'+
                                        '<li class="nav-item">'+
                                            '<a href="b_productSaleTitle_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>銷售標題管理</p></a></li>'+
                                    '</ul></li>'+
                                '<li class="nav-item" id="sidebar_order">'+
                                    '<a href="#" class="nav-link">'+                        
                                        '<i class="nav-icon fa-solid fa-cart-shopping"></i><p>訂單<i class="right fas fa-angle-left"></i></p></a>'+
                                    '<ul class="nav nav-treeview">'+
                                        '<li class="nav-item">'+
                                            '<a href="b_order_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>訂單管理</p></a></li>'+
                                        '<li class="nav-item">'+
                                            '<a href="b_orderState_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>狀態管理</p></a></li>'+
                                        '<li class="nav-item">'+
                                            '<a href="b_pay_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>付款管理</p></a></li>'+
                                        '<li class="nav-item">'+
                                            '<a href="b_delivery_list.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>交貨管理</p></a></li>'+
                                    '</ul></li>'+
                            '</ul></nav></div></aside>';
document.write(html);