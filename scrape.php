<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class='container-fluid'>
            
            <h1>Price Comparer</h1>
            <div class='row'>
                 <div class='col-xs-2'>
                    <h3>Company</h3>
                </div>
                <div class='col-xs-2'>
                    <h3>Aff Link</h3>
                </div>
                <div class='col-xs-2'>
                   <h3>Price</h3>
                </div>
            </div>
           <div class='row'>
                 <div class='col-xs-2'>
                    <h4>Amazon</h4>
                </div>
                <div class='col-xs-2'>
                    <a href="http://amzn.to/29Ilo7m">
                    <h4>LEGO Marvel Super Heroes</h4>
                    </a>
                </div>
                <div class='col-xs-2'>
                   <h4><?php
                   $affArray = create_affiliate_array();
                   print crawl_for_price($affArray[3], $affArray[4]);
                ?></h4>
                </div>
            </div>
            <div class='row'>
                 <div class='col-xs-2'>
                    <h4>BestBuy</h4>
                </div>
                <div class='col-xs-2'>
                    <a href="http://www.bestbuy.com/site/absolute-zombies-dvd-2015/29399177.p?skuId=29399177&ref=199&loc=2VP6ghPkFbA&acampID=29399177&siteID=2VP6ghPkFbA-9RV5ikbDbpEqtNTy9xYzNQ">
                    <h4>Zombies</h4>
                    </a>
                </div>
                <div class='col-xs-2'>
                <h4>
                <?php
                    $affArray = create_affiliate_array();
                    print crawl_for_price($affArray[1], $affArray[2]);
                ?>
                </h4>
                </div>
            </div>
            <div class='row'>
                 <div class='col-xs-2'>
                    <h4>GameStop</h4>
                </div>
                <div class='col-xs-2'>
                    <a href="http://click.linksynergy.com/link?id=2VP6ghPkFbA&offerid=271758.176087&type=2&murl=http%3A%2F%2Fwww.gamestop.com%2FCatalog%2FProductDetails.aspx%3Fsku%3D960996">
                    <h4>Big Trouble in Little China</h4>
                    </a>
                </div>
                <div class='col-xs-2'>
                <h4>
                <?php
                    $affArray = create_affiliate_array();
                    print crawl_for_price($affArray[5], $affArray[6]);
                ?>
                </h4>
                </div>
            </div>
            <div class='row'>
                 <div class='col-xs-2'>
                    <h4>Ebay</h4>
                </div>
                <div class='col-xs-2'>
                    <a href="http://rover.ebay.com/rover/1/711-53200-19255-0/1?icep_ff3=2&pub=5575159564&toolid=10001&campid=5337836705&customid=&icep_item=291693106316&ipn=psmain&icep_vectorid=229466&kwid=902099&mtid=824&kw=lg">
                    <h4>Skylanders</h4>
                    </a>
                </div>
                <div class='col-xs-2'>
                <h4>
                <?php
                    $affArray = create_affiliate_array();
                    print crawl_for_price($affArray[7], $affArray[8]);
                ?>
                </h4>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
//Will need to use curl for best buy
    function crawl_for_price($url, $regex){
        include_once('simple_html_dom.php');
        
        // create curl resource
        $ch = curl_init();
        
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13 Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $html_base = new simple_html_dom();
        $html_base->load($output);

        if(!$output){
            return "No Price";
        }
        
        //$html = str_get_html($output);

        if(empty($html_base)){
            return "No HTML";
        }
        else{
            $elem = $html_base->find($regex, 0);
            return $elem;
        }
        
    }
    
    
    function create_affiliate_array(){
        $affArray = array(
            1 => 'http://www.bestbuy.com/site/absolute-zombies-dvd-2015/29399177.p?skuId=29399177&ref=199&loc=2VP6ghPkFbA&acampID=29399177&siteID=2VP6ghPkFbA-9RV5ikbDbpEqtNTy9xYzNQ',
            2 => '//*[@id="priceblock-wrapper-wrapper"]/div[1]/div[1]/div[2]/div[1]/text()',
            3 => 'https://www.amazon.com/LEGO-Marvel-Super-Heroes-Xbox/dp/B00D7823Q6/ref=as_li_ss_tl?ie=UTF8&dpID=51U685svdvL&dpSrc=sims&preST=_AC_UL320_SR248,320_&psc=1&refRID=QK8XJP09F4PDCY9KKN9P&linkCode=sl1&tag=affdojo-20&linkId=8dd415657db81c3735f15aadf51d59bf',
            4 => '//*[@id="olp_feature_div"]/div/span[1]/span',
            5 => 'http://click.linksynergy.com/link?id=2VP6ghPkFbA&offerid=271758.176087&type=2&murl=http%3A%2F%2Fwww.gamestop.com%2FCatalog%2FProductDetails.aspx%3Fsku%3D960996',
            6 => '//*[@id="mainContentPlaceHolder_dynamicContent_ctl00_RepeaterRightColumnLayouts_RightColumnPlaceHolder_0_ctl00_0_LayoutStandardPanel_0"]/div[5]/div[2]/div[2]/div[2]/h3/span',
            7 => 'http://rover.ebay.com/rover/1/711-53200-19255-0/1?icep_ff3=2&pub=5575159564&toolid=10001&campid=5337836705&customid=&icep_item=291693106316&ipn=psmain&icep_vectorid=229466&kwid=902099&mtid=824&kw=lg',
            8 => '//*[@id="prcIsum"]'
            
        );
        return $affArray;
    }
    
    
?>
