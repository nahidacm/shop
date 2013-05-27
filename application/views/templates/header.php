
    <body>

        <div class="container">

            <div class="masthead">
                <div class="row-fluid">
                    <div class="span3">
                        <h3 class="muted">iShop</h3>
                    </div>
                    <div class="span2" class="cart_items">
                        Items : <span class="badge badge-warning"><?php echo $this->cart->total_items() ?></span>
                    </div>
                    <div class="span3" class="total_price">
                        Total Price : Tk.<span class="badge badge-important"><?php echo $this->cart->total() ?></span>
                    </div>
                    <div class="span4">
                        <button class="span4 btn btn-success">Check out</button>
                    </div>
                </div>
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container">
                            <ul class="nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">Category One</a></li>
                                <li><a href="#">Category Two</a></li>
                                <li><a href="#">Category Three</a></li>
                                <li><a href="#">Category Four</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.navbar -->
            </div>
