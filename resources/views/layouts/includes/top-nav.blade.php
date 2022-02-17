<header class="headernav sticky-top">
    <div class="containernav" >
        <section class="wrapper">
            <div class="header-item-left">
                <a href="./index.html" class="brand">M Blog</a>
            </div>
            <!-- Navbar Section -->
            <div class="header-item-center">
                <div class="overlay"></div>
                <nav class="menu" id="menu">
                    <div class="menu-mobile-header">
                        <button type="button" class="menu-mobile-arrow"><i class="ion ion-ios-arrow-back"></i></button>
                        <div class="menu-mobile-title"></div>
                        <button type="button" class="menu-mobile-close"><i class="ion ion-ios-close"></i></button>
                    </div>
                    <ul class="menu-section" style="margin:0px">
                        <li class="menu-item"><a href="#">Home</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Accounts <i class="ion ion-ios-arrow-down"></i></a>
                            <div class="menu-subs menu-column-1">
                                <ul>
                                    <li><a href="#">Register</a></li>
                                    <li><a href="#">Questions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Term of Cookies Term of Cookies</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item"><a href="#">Resources</a></li>
                        <li class="menu-item"><a href="#">Contact Us</a></li>
                    </ul>
                </nav>
            </div>

            <div class="header-item-right">
                <form class="searchbox">
                    <input type="search" wire:model="searchTerm" placeholder="Write Post Title for Search and Press Enter" name="search" class="searchbox-input" required>
                </form>
                <a href="#" class="menu-icon"><i class="ion ion-md-heart"></i></a>
                <a href="#" class="menu-icon searchbox-icon"><i class="ion ion-md-search"></i></a>
                <button type="button" class="menu-mobile-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </section>
    </div>
</header>
