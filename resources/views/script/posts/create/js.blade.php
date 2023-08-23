<script>

    "use strict";
    $(document).ready( function () {

        $(".schedule_block_item").hide();
        $(document.body).on('change','input[name=schedule_type]',function(){
            if($("input[name=schedule_type]:checked").val()=="later") {
                $(".schedule_block_item").show();
            } else {
                $("#schedule_time").val("");
                $(".schedule_block_item").hide();
            }
        });

        $(document.body).on('click','#submit_campaign',function(){
            let schedule_type = $("input[name=schedule_type]:checked").val();
            let schedule_time = $("#schedule_time").val();
            if(schedule_type=='later' && (schedule_time==""))
            {
                alert("Please select schedule time");
                return;
            }
        });

        var rolefor = $('#role_for').val();
        if(rolefor == '1') {
            $('#staff_block').show();
            $('#user_block').hide();
        } else {
            $('#staff_block').hide();
            $('#user_block').show();
        }

        $('#role_for').change(function(){
            if($('#role_for').val() == '1') {
                $('#staff_block').show();
                $('#user_block').hide();
            } else {
                $('#staff_block').hide();
                $('#user_block').show();
            }
        });
    });

    $(document).ready(function() {
        "use strict";

        var quill = new Quill('#input_description', {
            theme: 'snow'
        });

        var description = $("#description").val();
        quill.clipboard.dangerouslyPasteHTML(description);
        quill.root.blur();
        $('#input_description').on('keyup', function(){
            var input_description = quill.container.firstChild.innerHTML;
            $("#description").val(input_description);
        });
    });
</script>
