// update profile data... 
$("#profile_form").unbind('submit').bind('submit', function () {
    // e.preventDefault();
    event.preventDefault();
    var form = $(this);
    // console.log(form);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        // data: form.serialize(),
        // dataType: 'json',
        data: new FormData($('#profile_form')[0]),
        processData: false,
        contentType: false,
        success:function(response){
            response = JSON.parse(response);
            
            // alert(response.messages);
            $(document).Toasts('create', {
                class: response.class,
                title: response.title,
                // subtitle: 'Subtitle',
                body: response.messages
            });
            // location.reload();
            location.replace("includes/signout.php");
        },
        error:function(e){
            console.log(e);
        }
    })
})

// update profile image... 
function update_profile_image(){
    
    $("#update_profile_image").unbind('submit').bind('submit', function () {
        // e.preventDefault();
        event.preventDefault();
        var form = $(this);
        // console.log(form);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            // data: form.serialize(),
            // dataType: 'json',
            data: new FormData($('#update_profile_image')[0]),
            processData: false,
            contentType: false,
            success:function(response){
                response = JSON.parse(response);
                
                // alert(response.messages);
                $(document).Toasts('create', {
                    class: response.class,
                    title: response.title,
                    // subtitle: 'Subtitle',
                    body: response.messages
                });
                location.reload();
            },
            error:function(e){
                console.log(e);
            }
        })
    })
}


// update profile password... 
function update_profile_password(){
    
    $("#update_profile_password").unbind('submit').bind('submit', function () {
        // e.preventDefault();
        event.preventDefault();
        var form = $(this);
        // console.log(form);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            // data: form.serialize(),
            // dataType: 'json',
            data: new FormData($('#update_profile_password')[0]),
            processData: false,
            contentType: false,
            success:function(response){
                response = JSON.parse(response);
                
                // alert(response.messages);
                $(document).Toasts('create', {
                    class: response.class,
                    title: response.title,
                    // subtitle: 'Subtitle',
                    body: response.messages
                });
                location.reload();
            },
            error:function(e){
                console.log(e);
            }
        })
    })
}