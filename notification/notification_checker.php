<script>
$(document).ready(function(){
    var audio2;
    var flag = 0;
    audio2 = $("#not_sound")[0];

    function load_unseen_notification(view = '')
    {
        $.ajax({
   url:"../../notification/fetch_notification.php",
   method:"GET",
   data:{view:view},
   contentType:"application/json; charset=utf-8",
   dataType:"json",
   success:function(data)
   {

       $('.dropdown-menu').html(data.notification);
       if(data.unseen_notification > 0)
       {

           if(data.unseen_notification > flag){
               audio2.play();
               flag = data.unseen_notification;
           }

           $('.count').html(data.unseen_notification);

       }
       $('.message_count').html(data.unseen_message);
       $('.reminder_count').html(data.unseen_reminders);
       $('.bill_count').html(data.unseen_bills);
       $('.order_count').html(data.unseen_orders);
   }
  });
 }
/*
    function load_unseen_notification(view = '') {
        $.get("../../notification/fetch_notification.php",{view:view},function (data) {

            $('.dropdown-menu').html(data);
            if ((data[data.length-4]+data[data.length-3]) == "00")
            {

            }
            else if(data[data.length-3] == "0")
            {
                $('.count').html(data[data.length-4]);
                if(flag == 0){
                    audio2.play();
                    flag = 1;
                   // flag = data.unseen_notification;
                }
            }else {
                $('.count').html(data[data.length-4]+data[data.length-3]);
            }
        });
    }*/


    load_unseen_notification();

    $(document).on('click', '.dropdown-toggle', function(){
        $('.count').html('');
        load_unseen_notification('yes');
    });

    setInterval(function(){
        load_unseen_notification();;
    }, 2000);

});
</script>