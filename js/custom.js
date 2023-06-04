$(document).ready(function(){

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 101,
        },
        success: function (data) {

            var all_data = JSON.parse(data)
            var length = all_data.length;

            console.log(all_data)

            for (let i = 0; i<length;i++){
                let html = '';
                html += '<div class="people_list">';
                html += '<div class="content">';
                html  +=  '<img src="'+all_data[i].image+'" alt="" style="height:50px;width: 50px;">';
                html  +=  '<div class="details">';
                html  +=  '<a href="chatbox.php?id='+all_data[i].user_id+'"><span>'+all_data[i].full_name+'</span></a>';
                html  +=  '<p>Text this person</p>';
                html  +=  ' </div> </div>';
                html  +=  ' <span style="color:#4cd137"><i class="fa-solid fa-circle"></i></span></div>';





                $('.peopole_list_body').append(html);
            }



        }
    })






});