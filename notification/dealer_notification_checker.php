<script>
    $(document).ready(function(){
        var audio3;
        var flagg = 0;
        audio3 = $("#not_sound")[0];
        function load_unseen_notification(view = '')
        {
            $.ajax({
                url:"../notification/fetch_notification.php",
                method:"GET",
                data:{view:view},
                dataType:"json",
                success:function(data)
                {
                    $('.dropdown-menu').html(data.notification);
                    if(data.unseen_notification > 0)
                    {
                        if(data.unseen_notification > flagg){
                            audio3.play();
                            flagg = data.unseen_notification;
                        }

                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }

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