$(document).ready(function() {
  $('.q').hide();
  $('.cartForm').hide();

  $(document).on("click",".cartHealthy",function() {
    let id = $(this).data('product-id');
    $(this).parent().parent('tr').find('.q').show();
    var submit = $(this).parent().parent('tr').find('.q').find('.submit');
    $(submit).click(function() {
      var quantity = $(this).parent().parent('tr').find('.q').find('.quantity').val();
      $.ajax({
        type: 'post',
        data: { quantity: quantity, id: id },
        url: '../AJAX/insertHealthyCart.php',
        success: function(data) {
          $(this).parent().parent('tr').find('.add').hide();
          $(this).parent().parent('tr').find('.q').hide();
        }
      })
    })
  })

  $(document).on("click",".cartUnhealthy",function() {
    let id = $(this).data('product-id');
    $(this).parent().parent('tr').find('.q').show();
    var submit = $(this).parent().parent('tr').find('.q').find('.submit');
    $(submit).click(function() {
      var quantity = $(this).parent().parent('tr').find('.q').find('.quantity').val();
      $.ajax({
        type: 'post',
        data: { quantity: quantity, id: id },
        url: '../AJAX/insertUnhealthyCart.php',
        success: function(data) {
          $(this).parent().parent('tr').find('.add').hide();
          $(this).parent().parent('tr').find('.q').hide();
        }
      })
    })
  })

  $(document).on("click",".showForm", function() {
    $('.cartForm').show();
  })
})
