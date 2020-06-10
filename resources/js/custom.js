
// Online status o off toogle
$(function () {

    $('.toggle-class').change(function () {

        var is_active = $(this).prop('checked') == true ? 1 : 0;

        var user_id = $(this).data('id');



        $.ajax({

            type: "GET",

            dataType: "json",

            url: 'changeStatus',

            data: {
                'is_active': is_active,
                'user_id': user_id
            },

            success: function (data) {

                console.log(data.success)

            }

        });

    })

})

