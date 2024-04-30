(function ($) 
{
  "use strict";
         
});

    function areyousure()
    {
        return confirm('Are You Sure You Want Delete This');
    }
    
    $(function() {
    
        $('.chzn').chosen();
        
    });

    $(function() {
        $('#datable_1').DataTable({
        responsive: true,
        autoWidth: false,
        language: { search: "",
        searchPlaceholder: "Search",
        sLengthMenu: "_MENU_items"

        }
    });
    });

    $(function() {
        //bootstrap WYSIHTML5 - text editor
        $(".txtarea").wysihtml5();
    });

    $(function() {
        $( "#datepicker" ).pickmeup({
            format  : 'Y-m-d'
        });
    });

    $(function() {
        $('.datetimepicker').datetimepicker({
            format  : 'Y-m-d',
            timepicker:false
        });
    });


    function printData()
    {
      var print_div = document.getElementById("print-area");
      var print_area = window.open();
      print_area.document.write(print_div.innerHTML);
      print_area.document.close();
      print_area.focus();
      print_area.print();
      print_area.close();
      
    }
    $(document).on('click','.print-btn',function(){
          printData();
    });


$(function() {
    //bootstrap WYSIHTML5 - text editor
    $(".txtarea").wysihtml5();

     $('.datepicker').datetimepicker({
     lang:'en',
     i18n:{
      de:{
       months:[
        'Januar','Februar','März','April',
        'Mai','Juni','Juli','August',
        'September','Oktober','November','Dezember',
       ],
       dayOfWeek:[
        "So.", "Mo", "Di", "Mi", 
        "Do", "Fr", "Sa.",
       ]
      }
     },
     timepicker:false,
     format:'Y-m-d'
    });
    var base_url = $('#base_url').val(); 
    $('.client').on('change',function(e)
    {
        e.preventDefault();
        var case_id = this.value;
        if(case_id)
        {
            $.ajax({
                type: 'POST',
                url: base_url+"admin/new_invoice/get_case_data",
                data: {'case_id':case_id},
                dataType: 'json',
                success: function (response)
                {
                    console.log(response);
                    if(response.status == "success")
                    {
                        $('#client-data').html("");
                        $('#client-data').html(response.data);
                    }
                    else
                    {
                        $('#client-data').html("");
                    }
                },
                error:function(e)
                {
                    console.log(e);
                },
            });
        }
    });

    $(document).ready(function(){
        $(".client").trigger("change");
    });

    $(".add-more").on('click',function () {

        $('.chzn').chosen('destroy');
        var html = "";
        html = $(".copy_product_section").html();
        $(".after_product_section").append(html);
        $('.chzn').chosen();
    });

    $(document).on("click", ".remove_block_btn", function () {
      $(this).parents(".copied_product_section").remove();
      calculate_total_amount('');
      calculate_total_discount('');
      calculate_total_tax('');
      calculate_grand_total();
    });

    $(document).on('change','.product-name',function(e){
        var tax_percentage = ($('.tax-list').val() ? $('.tax-list').val() : 0);
        
        e.preventDefault();
        var product_id = this.value;
        var this_product_name = $(this);
        $.ajax({
            type: 'POST',
            url: base_url+"admin/new_invoice/get_product_data",
            data: {'product_id':product_id},
            dataType: 'json',
            success: function (response)
            {
                var div = this_product_name.closest('div[class^="row"]');
                
                console.log(response);
                if(response.status == "success")
                {
                    div.find('.quantity').val('1');
                    div.find('.price').val(response.data.sale_price);
                    div.find('.discount').val('0');
                    div.find('.amount-label').html(response.data.sale_price);
                    div.find('.amount-input').val(response.data.sale_price);
                    var tax_result = (div.find('.amount-input').val()*tax_percentage)/100;
                    tax_result = (tax_result > 0 ? tax_result : 'please select tax');
                    div.find('.tax-label').html(tax_result);
                    div.find('.tax-input').val(tax_result);
                    calculate_total_amount();
                    calculate_total_discount();
                    calculate_total_tax();
                    calculate_grand_total();
                }
                else
                {
                    div.find('.quantity').val('');
                    div.find('.price').val('');
                    div.find('.tax-label').html('');
                    div.find('.tax-input').val('');
                    div.find('.discount').val('');
                    div.find('.amount-label').html('');
                    div.find('.amount-input').val('');
                    calculate_total_amount('');
                    calculate_total_discount('');
                    calculate_total_tax('');
                    calculate_grand_total('');
                }
            },
            error:function(e)
            {
                console.log(e);
            },
        });
    }); 

    
    // $(document).on('keyup','.total_amount_discount',function(event)
    // {
    //   calculate_grand_total($(this).val());
    // });

    $(document).on('blur','.quantity , .price, .discount',function(event)
    {
        this.value = this.value.replace(/[^0-9\.]/g,'');
        var div = $(this).closest('div[class^="row"]');
        var price = div.find('.price').val();
        var quantity = div.find('.quantity').val();
        var tax_percentage = ($('.tax-list').val() ? $('.tax-list').val() : 0);
        var discount = div.find('.discount').val();
        if(this.value)
        {
           div.find('.amount-label').html(quantity * price);
           div.find('.amount-input').val(quantity * price);
           div.find('.quantity').val(quantity);
           var tax_result = (div.find('.amount-input').val()*tax_percentage)/100;
           tax_result = (tax_result > 0 ? tax_result : 'please select tax');
           div.find('.tax-label').html(tax_result);
           div.find('.tax-input').val(tax_result);  
           // console.log(calculate_grand_total()); 
           calculate_total_discount();
           calculate_total_amount();
           calculate_total_tax();
           calculate_grand_total();
        }
        else
        {
            div.find('.amount-label').html('enter numeric value in quantity');
            div.find('.amount-input').val('');
            div.find('.tax-label').html('');
            div.find('.tax-input').val(''); 
            div.find('.quantity').val('');
            calculate_total_amount('');
            calculate_total_tax('');
            calculate_total_discount('');
            calculate_grand_total('');
            

        }
    });

    $(document).on('change','.tax-list',function(){
      var tax_percentage = this.value;
      var selected_text = $(this).find("option:selected").text();
      
      $('.tax-type').html('Tax');
     
      $('.after_product_section').each(function() {
        var input_amount = $('.row_number_of_colum').find('.amount-input').val();

        var find_tax = (input_amount * tax_percentage)/100;
        $('.row_number_of_colum').find('.tax-label').html(find_tax);
        $('.row_number_of_colum').find('.tax-input').val(find_tax);
        
      });
      
      
      if(selected_text && tax_percentage)
      {
        $('.tax-type').html('Tax ( '+selected_text+' )');  
      }
    });


    function calculate_total_amount () {
      var total_amount = 0;
      $('.amount-input').each(function() {
         var amount_val = $(this).val();
         total_amount += isNaN(amount_val) || $.trim(amount_val)=="" ? 0 : parseFloat(amount_val);
      });
      $(".sub-total").html(total_amount.toFixed(2));
      $("input[class=sub-total-input]").val(total_amount.toFixed(2));
    }

    function calculate_total_discount () {
      var total_discount = 0;
      $('.discount').each(function() {
         var discount_val = $(this).val();
         total_discount += isNaN(discount_val) || $.trim(discount_val)=="" ? 0 : parseFloat(discount_val);
      });
      $(".discount-total").html(total_discount.toFixed(2));
      $("input[class=discount-total-input]").val(total_discount.toFixed(2));
    }

    function calculate_total_tax () {
      var total_tax = 0;
      $('.tax-input').each(function() {
         var tax_val = $(this).val();
         total_tax += isNaN(tax_val) || $.trim(tax_val)=="" ? 0 : parseFloat(tax_val);
      });
      $(".tax-total").html(total_tax.toFixed(2));
      $("input[class=tax-total-input]").val(total_tax.toFixed(2));
    }
    
    function calculate_grand_total () {
      var grand_total = 0;
      var sub_total_gross = ($('.sub-total').html() ? $('.sub-total').html() : 0);
      var discount_gross = ($('.discount-total').html() ? $('.discount-total').html() : 0);
      var tax_gross = ($('.tax-total').html() ? $('.tax-total').html() : 0);
      //console.log($('#total_amount_discount_text').val());
      grand_total = sub_total_gross - discount_gross; //+ parseFloat(tax_gross);
      grand_total = grand_total + parseFloat(tax_gross);
      $(".amount-total").html(grand_total.toFixed(2));
      $("input[class=gross-total-input]").val(grand_total.toFixed(2));
    }
   
    

});

