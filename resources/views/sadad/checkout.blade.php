    <style>
        .close-btn{ 
            height: auto; 
            width: auto; 
            -webkit-appearance: none !important; 
            background: none !important; 
            border: 0px; 
            position: absolute; 
            right: 10px; 
            z-index: 11; 
            cursor: pointer; 
            outline: 0px !important; 
            box-shadow: none; 
            top: 15px; 
        }
        .close, .close:hover{ 
            color: #000; 
            font-size:30px;
        }
        .modal-body{ 
            padding: 0px; 
            border-radius: 15px; 
        }
        #onlyiframe{ 
            width:100% !important; 
            height:100vh !important; 
            overflow: hidden !important; 
            border:0; 
            top: 0; 
            left: 0; 
            bottom: 0; 
            right: 0; 
        }
        #includeiframe{ 
            height:100vh !important; 
            overflow: hidden !important; 
            border:0; 
        }
        .modal-backdrop { 
            background-color: #000 !important; 
        } 
        ul.order_details{ 
            display: none !important; 
        }    
 </style>

<form action="https://secure.sadadqa.com/webpurchasepage" method="post" id="paymentform" name="paymentform" data-link="https://secure.sadadqa.com/webpurchasepage">
        <input type="hidden" name="merchant_id" id="merchant_id" value="5410843">
        <input type="hidden" name="ORDER_ID" id="ORDER_ID" value="4641">

        <input type="hidden" name="WEBSITE" id="WEBSITE" value="https://tagxi-super-bidding.ondemandappz.com">
        <input type="hidden" name="TXN_AMOUNT" id="TXN_AMOUNT" value="50.00">

        <input type="hidden" name="CUST_ID" id="CUST_ID" value="example@example.com">
        <input type="hidden" name="EMAIL" id="EMAIL" value="example@example.com">

        <input type="hidden" name="MOBILE_NO" id="MOBILE_NO" value="999999999">
        <input type="hidden" name="SADAD_WEBCHECKOUT_PAGE_LANGUAGE" id="SADAD_WEBCHECKOUT_PAGE_LANGUAGE" value="ENG">

        <input type="hidden" name="CALLBACK_URL" id="CALLBACK_URL" value="https://tagxi-super-bidding.ondemandappz.com">
        <input type="hidden" name="txnDate" id="txnDate" value="2020-09-19 13:01:33">

        <input type="hidden" name="productdetail[0][order_id]" value="4641">
        <input type="hidden" name="productdetail[0][itemname]" value="Sample Product">

        <input type="hidden" name="productdetail[0][amount]" value="50">
        <input type="hidden" name="productdetail[0][quantity]" value="1">

        <input type="hidden" name="productdetail[0][type]" value="line_item">
        <input type="hidden" name="checksumhash" value="jTCNgRkqFs9PBstGWZrm9jnyyrIWvly9wbiP+NlGKFU3oCzXFawKPvI3wChqcJuqOPhou9JNU9G/PwkgKHrDgQJcgH8Nw8YdnuExZnDsGmQ=">
             
        <script type="text/javascript">
            document.gosadad.submit();
        </script>
</form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal-bs3patch.min.css" crossorigin="anonymous">


<!-- Modal -->
<div id="container_div_sadad">
    <div class="modal fade not_hide_sadad" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close-btn" onClick="closemodal();" aria-label="Close"> 
                    <span class="close">×</span> 
                </button>
                <div class="modal-body">
                    <iframe name="includeiframe" id="includeiframe" frameborder="0" scrolling="no"></iframe> 
                </div>
            </div>
        </div>
    </div>
    <iframe name="onlyiframe" id="onlyiframe" border="0" class="not_hide_sadad" frameborder="0" scrolling="no"></iframe> 
    </div>

    <script>
        function closemodal()
        {
            $('#exampleModal').modal('hide');
                //When modal popup is closed (So payment is cancelled) 
        }
        jQuery(document).ready(function($){
            if ($('#showdialog').val() == 1) { 
                $('#exampleModal').modal('show'); 
                $('#paymentform').attr('target', 'includeiframe').submit(); 
                $('#onlyiframe').remove(); 
                } 
            else { $('#exampleModal').remove(); 
                $('#paymentform').attr('target', 'onlyiframe').submit(); } 
                $('iframe').load(function() { 
                $(this).height( 
                $(this).contents().find("body").height() ); 
            if(this.contentWindow.location=='Your callback URL here'){ 
                //Customer redirected to callback URL withhin iFrame so do your further processing here. Redirect to success page or showing success/failed message. 
                } 
            }); 
        });
    </script>